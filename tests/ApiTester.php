<?php

use Faker\Factory as Faker;
class ApiTester extends TestCase {

    protected $faker;
    protected $times =1;

    /**
     * ApiTester constructor.
     * @param $faker
     */
    public function __construct()
    {
        $this->faker = Faker::create() ;
    }

    protected function times($count)
    {
        $this->times = $count;

        return $this;
    }

    protected function getJson($uri)
    {
        return json_decode($this->call('GET', $uri)->getContent());
    }

}