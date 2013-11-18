<?php

/**
 * Simple generator of lexical analyzers
 *
 * Parses the source code in some programming language to obtain information
 * about tokens (atoms of the lexical grammar) which make up the source code.
 *
 * @author       Fedor Kurilov <fegorus@gmail.com>
 * @copyright    2013 Fedor Kurilov <fegorus@gmail.com>
 * @license      http://www.opensource.org/licenses/mit-license.php MIT
 * @version      0.1
 */

class Scanner {

    /**
     * @var array tokens of the lexical grammar
     */
    public $tokens = array();
    /**
     * @var array reserved words of the lexical grammar
     */
    public $reserved = array();
    /**
     * @var array
     */
    private $code;
    /**
     * @var string value of found token
     */
    private $t_value;
    /**
     * @var string type of found token
     */
    private $t_type;
    /**
     * @var string visibility of found token
     */
    private $t_visible;
    /**
     * @var array
     */
    private $result = array();

    /**
     * Analyzes the code
     *
     * @param string $code code to be analyzed
     * @return void
     */
    public function analyse($code) {

        // split code into separate lines
        $this->code = explode(PHP_EOL, $code);

        // analyze each line of code
        foreach ($this->code as $line_number => $line_code) {
            $line_length = strlen($line_code);
            $offset = 0; // offset from the beginning of line
            while ($offset < $line_length) {
                // select substring from offset to the end of line
                $str = substr($line_code, $offset);
                // check it for presence of any token
                if ($this->match($str)) {
                    if ($this->t_visible === true) {
                        // put information about visible token into resulting array
                        $this->result[] = array(
                            'row' => $line_number,
                            'col' => $offset,
                            't_value' => $this->t_value,
                            't_type' => $this->t_type
                        );
                    }
                    // increase offset by the length of the token found
                    $offset += strlen($this->t_value);
                } else {
                    // first symbol of the line is error lexeme
                    $this->result[] = array(
                        'row' => $line_number,
                        'col' => $offset,
                        't_value' => '',
                        't_type' => 'ERROR'
                    );
                    $offset += 1;
                }
            }
        }

    }


    /**
     * Returns analysis result
     * 
     * Returns array with information about each token as:
     * Array
     * (
     *     [0] => Array
     *            (
     *                ['row'] => "0"
     *                ['col'] => "0"
     *                ['t_value'] => "begin"
     *                ['t_type'] => "kwBEGIN"
     *            )
     *     ...
     * )
     *
     * @return array
     */
    public function get_result() {

        return $this->result;

    }

    /**
     * Determines token presence in the beginning of the string
     * and saves information about the token found
     *
     * @param string $str string to be checked
     * @return bool
     */
    private function match($str) {

        $this->t_value = '';
        $this->t_type = '';

        // check for presence of each class of tokens
        foreach ($this->tokens as $type => $property) {
            if (preg_match($property['pattern'], $str, $matches)) {
                // define the max. length matching substring as token
                // to avoid premature defining (e.g. '>' in '>=')
                if (strlen($matches[1]) > strlen($this->t_value)) {
                    $this->t_value = $matches[1];
                    $this->t_type = $type;
                    $this->t_visible = $property['visible'];
                }
            }
        }

        // if reserved words list is specified,
        // check whether the found token is reserved
        if (isset($this->reserved)) {
            foreach ($this->reserved as $type => $word) {
                if (strcasecmp($this->t_value, $word) == 0) {
                        $this->t_type = $type;
                        $this->t_visible = true;
                }
            }
        }

        // return false if the token was not found
        return ($this->t_value) ? true : false;

    }

}
