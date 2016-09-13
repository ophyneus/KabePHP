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
          }
          if($rida == $this->aktiivserida && $veerg == $this->aktiivseveerg){
            echo $this->aktiivserida;
            echo $this->aktiivseveerg;
            $stiil.="font-size: 150%;";
          }
          $lahter = "&nbsp;";
          if(in_array($this->laud[$rida][$veerg], ["m", "v"])){
            $lahter = "<a href='?rida=$rida&amp;veerg=$veerg'>".
              $this->laud[$rida][$veerg]."</a>";
          }
          $t.="<td style='$stiil'>$lahter</td>";
        }
        $t.="</tr>";
      }
      $t.="</table>";
      return $t;
    }
    function useURL(){
      if(isSet($_REQUEST["rida"])){
        $this->aktiivserida = intval($_REQUEST["rida"]);
      }
      if(isSet($_REQUEST["veerg"])){
        $this->aktiivseveerg = intval($_REQUEST["veerg"]);
      }
    }
  }
?>
