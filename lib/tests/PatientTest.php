<?php

class PatientTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->get('/patients')
             ->seeJsonStructure([
                 'name',
                 'pet' => [
                     'name', 'age'
                 ]
             ]);
    }
}