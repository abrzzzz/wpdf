<?php
namespace Abrz\WPDF\Contracts;

use Abrz\WPDF\Blueprint;

interface TableContract
{

    public static function up(Blueprint $blueprint);

    public static function down(Blueprint $blueprint);
    

}