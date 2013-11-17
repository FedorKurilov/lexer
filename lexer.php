<?php

/**
 * Класс лексического анализатора (сканера).
 *
 * Проводит разбор исходного кода на некотором языке программирования с целью получения 
 * информации о наборе лексем (единиц языка), составляющих данный исходный код.
 *
 * @author Федор Курилов <fegorus@gmail.com>
 * @version 1.0
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
     * @var string
     */
    private $lex_value;
    /**
     * @var string
     */
    private $lex_type;
    /**
     * @var string
     */
    private $lex_visible;
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
                    if ($this->lex_visible === true) {
                        // save information about visible token
                        $this->result[] = array(
                            'row' => $line_number,
                            'col' => $offset,
                            'lex_value' => $this->lex_value,
                            'lex_type' => $this->lex_type
                        );
                    }
                    // increase offset by the length of the token found
                    $offset += strlen($this->lex_value);
                } else {
                    // first symbol of the line is error lexeme
                    $this->result[] = array(
                        'row' => $line_number,
                        'col' => $offset,
                        'lex_value' => '',
                        'lex_type' => 'ERROR'
                    );
                    $offset += 1;
                }
            }
        }

    }


    /**
     * Returns analysis result
     *
     * Результат отдается в виде массива с информацией о каждой лексеме:
     *     Array
     *     (
     *         [0] => Array
     *                (
     *                    ['row'] => "0"
     *                    ['col'] => "0"
     *                    ['lex_value'] => "begin"
     *                    ['lex_type'] => "kwBegin"
     *                )
     *         ...
     *     )
     *
     * @return array
     */
    public function get_result() {

        return $this->result;

    }

    /**
     * Определяет наличие в начале строки лексемы какого-либо класса.
     *
     * @param string $str Проверяемая строка
     * @return bool
     */
    private function match($str) {

        $this->lex_value = '';
        $this->lex_type = '';

        // пробегаем по каждому классу лексем
        foreach ($this->tokens as $type => $property) {
            // если в начале строки найдена лексема какого-либо класса
            if (preg_match($property['pattern'], $str, $matches)) {
                // и если длина этой лексемы больше длины уже найденной лексемы
                if (strlen($matches[1]) > strlen($this->lex_value)) {
                    // сохраняем информацию о новой лексеме во временный массив
                    $this->lex_value = $matches[1];
                    $this->lex_type = $type;
                    $this->lex_visible = $property['visible'];
                }
            }
        }

        // если задан список зарезервированных (ключевых) слов
        // проверяем, является ли найденная лексема ключевым словом
        if (isset($this->reserved)) {
            foreach ($this->reserved as $type => $word) {
                if (strcasecmp($this->lex_value, $word) == 0) {
                        $this->lex_type = $type;
                        $this->lex_visible = true;
                }
            }
        }

        return ($this->lex_value) ? true : false;

    }

}
