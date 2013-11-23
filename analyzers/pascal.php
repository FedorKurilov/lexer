<?php

/**
 * Lexical analyzer for Pascal
 * 
 * @author       Fedor Kurilov <fegorus@gmail.com>
 * @copyright    2013 Fedor Kurilov <fegorus@gmail.com>
 * @license      http://www.opensource.org/licenses/mit-license.php MIT
 */

class PascalLexer extends Lexer {

    public $token_classes = array(
        'EQ'          => array( 'pattern' => '/^(=)/', 'delimiter' => true ),                              // '='
        'NE'          => array( 'pattern' => '/^(\<\>)/', 'delimiter' => true ),                           // '<>'
        'LT'          => array( 'pattern' => '/^(\<)/', 'delimiter' => true ),                             // '<'
        'GT'          => array( 'pattern' => '/^(\>)/', 'delimiter' => true ),                             // '>'
        'LE'          => array( 'pattern' => '/^(\<=|=\<)/', 'delimiter' => true ),                        // <=
        'GE'          => array( 'pattern' => '/^(\>=|=\>)/', 'delimiter' => true ),                        // >=
        'PLUS'        => array( 'pattern' => '/^(\+)/', 'delimiter' => true ),                             // '+'
        'MINUS'       => array( 'pattern' => '/^(-)/', 'delimiter' => true ),                              // '-'
        'ASTERISK'    => array( 'pattern' => '/^(\*)/', 'delimiter' => true ),                             // '*'
        'SLASH'       => array( 'pattern' => '/^(\/)/', 'delimiter' => true ),                             // '/'
        'SEMICOLON'   => array( 'pattern' => '/^(;)/', 'delimiter' => true ),                              // ';'
        'COLON'       => array( 'pattern' => '/^(:)/', 'delimiter' => true ),                              // ':'
        'ASSIGN'      => array( 'pattern' => '/^(:=)/', 'delimiter' => true ),                             // ':='
        'COMMA'       => array( 'pattern' => '/^(,)/', 'delimiter' => true ),                              // ','
        'LPAREN'      => array( 'pattern' => '/^(\()/', 'delimiter' => true ),                             // '('
        'RPAREN'      => array( 'pattern' => '/^(\))/', 'delimiter' => true ),                             // ')'
        'LBRACKET'    => array( 'pattern' => '/^(\[)/', 'delimiter' => true ),                             // '['
        'RBRACKET'    => array( 'pattern' => '/^(\])/', 'delimiter' => true ),                             // ']'
        'CIRCUMFLEX'  => array( 'pattern' => '/^(\^)/', 'delimiter' => true ),                             // '^'
        'DOT'         => array( 'pattern' => '/^(\.)/', 'delimiter' => true ),                             // '.'
        'DOUBELDOT'   => array( 'pattern' => '/^(\.\.)/', 'delimiter' => true ),                           // '..'
        'ID'          => array( 'pattern' => '/^([a-zA-Z_][a-zA-Z0-9_]*)/' ),                              // identifier
        'NUMBER'      => array( 'pattern' => '/^([0-9]+)/' ),                                              // number
        'HEXNUMBER'   => array( 'pattern' => '/^(\$[0-9a-fA-F]+)/' ),                                      // hexadecimal number
        'REALNUMBER'  => array( 'pattern' => '/^([0-9]+\.[0-9]+([eE][+-]?[0-9]+)?)/' ),                    // real number
        'STRING'      => array( 'pattern' => '/^(\'(.*?)\')/' ),                                           // string
        'COMMENT'     => array( 'pattern' => '/^((\{|\(\*)(.*?)(\}|\*\)))/', 'invisible' => true ),        // comment
        'BLANK'       => array( 'pattern' => '/^([\s\t])/', 'invisible' => true, 'delimiter' => true ),    // space or \t
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
        'kwNEW'          => 'new',
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
