# Lexer

Just a simple lexical analyzer generator, only for educational purposes. In real projects use special lexer generators like **Lex** and **Quex** (see http://catalog.compilertools.net/lexparse.html).

To use Lexer, you must specify list of token classes and optional list of reserved words.
Each token class must be described as:
```php
'IDENTIFIER' => array( 'pattern' => '/^([a-zA-Z])/', 'invisible' => false, 'delimiter' => false )
```
Where 'invisible' and 'delimiter' parameters are optional.

See an example in /analysers directory.

![image alt][1]
## Todo
 - support of multiline tokens (e.g., comments)
 - code refactoring

## License
MIT License (see LICENSE file for details)

[1]: https://raw.github.com/FedorKurilov/lexer/master/la.png
