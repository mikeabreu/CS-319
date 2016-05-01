<?php

class Formatter
{
    public function __construct()
    {

    }

    public function format($html, $options=null)
    {
        $center = key_exists("center", $options) ? 'center-align' : '';
        $valign = key_exists("valign", $options) ? 'valign' : '';
        $card_color = key_exists("card_color", $options) ? $options["card_color"] : '';
        $card_color_extra = key_exists("card_color_extra", $options) ? $options["card_color_extra"] : '';
        $col = key_exists("col", $options) ? $options["col"] : 's12';

        if (key_exists("card", $options)) {
            $output = <<<EOF
        <div class="row $center $valign">
            <div class="col $col">
                <div class="card-panel $card_color $card_color_extra">
                    $html
                </div>
            </div>
        </div>
EOF;
        } else {
            $output = <<<EOF
        <div class="row $center $valign">
            <div class="col $col">
                $html
            </div>
        </div>
EOF;
        }

        return $output;
    }
}

$Formatter = new Formatter();
$format =& $Formatter; // alias for Formatter object
