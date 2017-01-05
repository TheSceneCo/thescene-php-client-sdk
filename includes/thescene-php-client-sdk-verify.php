<?php
/* 
Copyright (C) 2016 TheScene.Co
This file is part of TheScene.Co PHP Client SDK.

Author: M Yasir Siddique
Email: yasir2014@gmail.com

TheScene.Co PHP Client SDK is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

TheScene.Co PHP Client SDK is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU Lesser General Public License for more details.

You should have received a copy of the Lesser GNU General Public License.
*/

function thescene_encrypt($thescene_text)
{
  for($i=0; $i<5;$i++)
  {
    $str=strrev(base64_encode($thescene_text));
  }
  return $str;
}

function thescene_decrypt($thescene_text)
{ 
  for($i=0; $i<5;$i++)
  {
    $str=base64_decode(strrev($thescene_text));
  }
  return $str;
}