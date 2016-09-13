<?php

  class Kabe{
    public $laud = [
      ".v.v.v.v",
      "v.v.v.v.",
      ".v.v.v.v",
      "r.r.r.r.",
      ".r.r.r.r",
      "m.m.m.m.",
      ".m.m.m.m",
      "m.m.m.m."
    ];
    function kuva(){
      $t = "<table>";
      for($rida = 0; $rida < 8; $rida++){
        $t.="\n<tr>";
        for($veerg = 0; $veerg < 8; $veerg++){
          $t.="<td>".$this->laud[$rida][$veerg]."</td>";
        }
        $t.="</tr>";
      }
      $t.="</table>";
      return $t;
    }
  }
  $k1 = new Kabe();
  $k1->laud[2][1] = "r";
  echo $k1->laud[2][1];
  echo $k1->kuva();
?>
