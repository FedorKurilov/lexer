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

if(!defined('REQUIRED')) exit('Прямой доступ к файлу запрещен');

class Scanner {

    /**
     * @var array Массив терминалов языка (классов лексем)
     */
     public $terminals = array();
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
     * Запускает анализ кода.
     *
     * @param string $code Код, подлежащий анализу
     * @return void
     */
    public function analyse($code) {

        // представляем код построчно в виде массива
        $this->code = explode(PHP_EOL, $code);

        // рассматриваем все строки кода
        foreach ($this->code as $line_number => $line_code) {
            $line_length = strlen($line_code);
            // смещение относительно начала строки
            $offset = 0;
            // пока смещение не достигнет конца строки
            while ($offset < $line_length) {
                // выделяем подстроку - от позиции смещения до конца строки
                $str = substr($line_code, $offset);
                // проверяем ее на наличие лексемы
                if ($this->match($str)) {
                    // если лексема найдена
                    if ($this->lex_visible === true) {
                        // информацию о видимой лексеме сохраняем в результирующий массив
                        $this->result[] = array( 'row' => $line_number,
                                     'col' => $offset,
                                     'lex_value' => $this->lex_value,
                                     'lex_type' => $this->lex_type
                                       );
                    }
                    // увеличиваем смещение на длину найденной лексемы
                    $offset += strlen($this->lex_value);
                } else {
                    // если нет соответствий ни одному из классов,
                    // то считаем лексему ошибочной
                    $this->result[] = array( 'row' => $line_number,
                                 'col' => $offset,
                                 'lex_value' => '',
                                 'lex_type' => 'tERROR'
                                   );
                    // и увеличиваем смещение на 1
                    $offset += 1;
                }
            }
        }

    }


    /**
     * Возвращает результат анализа.
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
        foreach ($this->terminals as $type => $property) {
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
