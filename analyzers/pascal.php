<?php

/**
 * Lexical analyzer for Pascal
 * 
 * @author       Fedor Kurilov <fegorus@gmail.com>
 * @copyright    2013 Fedor Kurilov <fegorus@gmail.com>
 * @license      http://www.opensource.org/licenses/mit-license.php MIT
 * @version      0.1
 */

class PascalLex extends Lexer {

    public $terminals = array(
        'EQ'          => array( 'pattern' => '/^(=)/', 'visible' => true ),                           // '='
        'NE'          => array( 'pattern' => '/^(\<\>)/', 'visible' => true ),                        // '<>'
        'LT'          => array( 'pattern' => '/^(\<)/', 'visible' => true ),                          // '<'
        'GT'          => array( 'pattern' => '/^(\>)/', 'visible' => true ),                          // '>'
        'LE'          => array( 'pattern' => '/^(\<=|=\<)/', 'visible' => true ),                     // <=
        'GE'          => array( 'pattern' => '/^(\>=|=\>)/', 'visible' => true ),                     // >=
        'PLUS'        => array( 'pattern' => '/^(\+)/', 'visible' => true ),                          // '+'
        'MINUS'       => array( 'pattern' => '/^(-)/', 'visible' => true ),                           // '-'
        'ASTERISK'    => array( 'pattern' => '/^(\*)/', 'visible' => true ),                          // '*'
        'SLASH'       => array( 'pattern' => '/^(\/)/', 'visible' => true ),                          // '/'
        'SEMCOLON'    => array( 'pattern' => '/^(;)/', 'visible' => true ),                           // ';'
        'COLON'       => array( 'pattern' => '/^(:)/', 'visible' => true ),                           // ':'
        'ASSIGN'      => array( 'pattern' => '/^(:=)/', 'visible' => true ),                          // ':='
        'COMMA'       => array( 'pattern' => '/^(,)/', 'visible' => true ),                           // ','
        'LPRNTHS'     => array( 'pattern' => '/^(\()/', 'visible' => true ),                          // '('
        'RPRNTHS'     => array( 'pattern' => '/^(\))/', 'visible' => true ),                          // ')'
        'LBRACKET'    => array( 'pattern' => '/^(\[)/', 'visible' => true ),                          // '['
        'RBRACKET'    => array( 'pattern' => '/^(\])/', 'visible' => true ),                          // ']'
        'CRCMFL'      => array( 'pattern' => '/^(\^)/', 'visible' => true ),                          // '^'
        'DOT'         => array( 'pattern' => '/^(\.)/', 'visible' => true ),                          // '.'
        'DBLDOT'      => array( 'pattern' => '/^(\.\.)/', 'visible' => true ),                        // '..'
        'ID'          => array( 'pattern' => '/^([a-zA-Z_][a-zA-Z0-9_]*)/', 'visible' => true ),      // identifier
        'NUM'         => array( 'pattern' => '/^(\d+)/', 'visible' => true ),                         // number
        'HEXNUM'      => array( 'pattern' => '/^(\$[0-9a-fA-F]+)/', 'visible' => true ),              // hexadecimal number
        'REALNUM'     => array( 'pattern' => '/^(\d+\.\d+([eE][+-]?\d+)?)/', 'visible' => true ),     // real number
        'STRING'      => array( 'pattern' => '/^(\'(.*?)\')/', 'visible' => true ),                   // string
        'COMMENT'     => array( 'pattern' => '/^((\{|\(\*)(.*?)(\}|\*\)))/', 'visible' => false ),    // comment
        'BLANK'       => array( 'pattern' => '/^([\s\t])/', 'visible' => false ),                     // space or \t
    );

    public $reserved = array(
        'kwAND'          => 'and',
        'kwARRAY'        => 'array',
        'kwBEGIN'        => 'begin',
        'kwCASE'         => 'case',
        'kwCONST'        => 'const',
        'kwDIV'          => 'div',
        'kwDO'           => 'do',
        'kwDOWNTO'       => 'downto',
        'kwELSE'         => 'else',
        'kwEND'          => 'end',
        'kwFILE'         => 'file',
        'kwFOR'          => 'for',
        'kwFUNCTION'     => 'function',
        'kwGOTO'         => 'goto',
        'kwIF'           => 'if',
        'kwIN'           => 'in',
        'kwLABEL'        => 'label',
        'kwMOD'          => 'mod',
        'kwNIL'          => 'nil',
        'kwNOT'          => 'not',
        'kwOF'           => 'of',
        'kwPACKED'       => 'packed',
        'kwPROCEDURE'    => 'procedure',
        'kwPROGRAM'      => 'program',
        'kwRECORD'       => 'record',
        'kwREPEAT'       => 'repeat',
        'kwSET'          => 'set',
        'kwTHEN'         => 'then',
        'kwTO'           => 'to',
        'kwTYPE'         => 'type',
        'kwUNTIL'        => 'until',
        'kwVAR'          => 'var',
        'kwWHILE'        => 'while',
        'kwWITH'         => 'with',
    );

}
