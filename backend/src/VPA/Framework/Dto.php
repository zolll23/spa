<?php

namespace VPA\Framework;

class Dto
{
    public function toArray(): array
    {
        return json_decode(json_encode($this), true);
    }
}