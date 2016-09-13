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
    private $aktiivserida = 1;
    private $aktiivseveerg = 2;
    function html(){
      $t = "<table>";
      for($rida = 0; $rida < 8; $rida++){
        $t.="\n<tr>";
        for($veerg = 0; $veerg < 8; $veerg++){
          $stiil = "";
          if($this->laud[$rida][$veerg]!="."){
            $stiil.="background-color: lightgray;";
          }else if($rida == $this->aktiivserida && $veerg == $this->aktiivseveerg){
            $stiil.="color: red;";
          }
          $t.="<td style='$stiil'>".$this->laud[$rida][$veerg]."</td>";
        }
        $t.="</tr>";
      }
      $t.="</table>";
      return $t;
    }
  }
  $k1 = new Kabe();
?>
