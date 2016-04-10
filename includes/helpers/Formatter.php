<?php

class Formatter
{
    public function __construct()
    {

    }

    public function format($html, $options=null)
    {
        $center = $options["center"] ? 'center-align' : '';
        $valign = $options["valign"] ? 'valign' : '';
        $card_color = $options["card_color"] ? $options["card_color"] : '';
        $card_color_extra = $options["card_color_extra"] ? $options["card_color_extra"] : '';
        $col = $options["col"] ? $options["col"] : 's12';

        if ($options["card"]) {
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