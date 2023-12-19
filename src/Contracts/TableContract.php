<?php
namespace Abrz\WPDF\Contracts;

interface TableContract
{

    /**
     * Creating and Altering table logic
     *
     * @return void
     */
    public static function up();

    /**
     * Droping table logic
     *
     * @return void
     */
    public static function down();
    

}