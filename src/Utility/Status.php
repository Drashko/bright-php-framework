<?php

namespace src\Utility;

class Status
{
    //range from 10 to 90
    public const User = [
        ['id' => 10 , 'name' => 'Pending'],
        ['id' => 20 , 'name' => 'Active'],
        ['id' => 30 , 'name' => 'Blocked'],
        ['id' => 40 , 'name' => 'Deleted'],
    ];
    //range from 100 to 190
    public const Project = [
        ['id' => 100 , 'name' => 'Pending'],
        //['id' => 120 , 'name' => 'Active'],
        ['id' => 130 , 'name' => 'In Progress'],
        ['id' => 140 , 'name' => 'Closed'],
        ['id' => 150 , 'name' => 'Complete'],
        ['id' => 160 , 'name' => 'Stopped'],
    ];

    //range from 200 to 400
    public const Role = [
        ['id' => 200 , 'name' => 'Super Administrator'],
        ['id' => 220 , 'name' => 'Administrator'],
        ['id' => 230 , 'name' => 'Client'],
        ['id' => 240 , 'name' => 'Customer'],
        ['id' => 250 , 'name' => 'User'],
        ['id' => 260 , 'name' => 'Guest'],
    ];




}