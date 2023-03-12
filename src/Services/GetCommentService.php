<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\JsonResponse;

class GetCommentService
{
    private $description;

    public function __construct($desc)
    {
        $this->description = $desc;
    }

    public function GetComment()
    {
        $json_data = array();
        $idx = 0;
        foreach ($this->description as $desc) {
            $temp = array(
                'owner' => $desc->getOwnerDescription()->getEmail(),
                'desc' => $desc->getDescription()
            );
            $json_data[$idx++] = $temp;
        }
        return new JsonResponse($json_data);
    }
}