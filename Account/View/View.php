<?php

namespace Account\View;

class View
{
      /** @var string */
    private $templatesPath;

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    /**
     * Передача данных в поток вывода через буфер
     * @param string $templateName
     * @param array $vars
     * @param int $code 
     * @return void
     */

    public function renderHtml(string $templateName, array $vars = [], int $code = 200)
    {
        http_response_code($code);
        extract($vars);

        ob_start();
        include $this->templatesPath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();
        echo $buffer;
    }
}