<?php
  class Kabe{
	  private $laud=[
	  ".v.v.v.v",
		"v.v.v.v.",
		".v.v.v.v",
		"r.r.r.r.",
		".r.r.r.r",
		"m.m.m.m.",
		".m.m.m.m",
		"m.m.m.m."
	  ];
	  private $aktiivserida = -1;
	  private $aktiivseveerg = -1;
    private $viimaneNupp = "v";
	  function html(){
		  $t="<table>";
		  for($rida=0; $rida<8; $rida++){
			  $t.="\n<tr>";
			  for($veerg=0; $veerg<8; $veerg++){
				  $stiil="";
				  if($this->laud[$rida][$veerg]!="."){
					  $stiil.="background-color: lightgray;";
				  }
				  if($rida==$this->aktiivserida && $veerg==$this->aktiivseveerg){
					  $stiil.="font-weight: bold;";
				  }
				  $lahter="&nbsp;";
				  if(in_array($this->laud[$rida][$veerg], ["m"])){
            $lahter="<a href='?rida=$rida&amp;veerg=$veerg'><div id='must'>".
					    $this->laud[$rida][$veerg]."</div></a>";
				  }
          if(in_array($this->laud[$rida][$veerg], ["v"])){
            $lahter="<a href='?rida=$rida&amp;veerg=$veerg'><div id='valge'>".
					    $this->laud[$rida][$veerg]."</div></a>";
				  }
          if(in_array($this->laud[$rida][$veerg], ["r"])){
            $lahter="<a href='?rida=$rida&amp;veerg=$veerg'><div id='tyhi'>".
					    $this->laud[$rida][$veerg]."</div></a>";
				  }
				  $t.="<td style='$stiil'>$lahter</td>";
			  }
			  $t.="</tr>";
		  }
		  $t.="</table>";
		  return $t;
	  }
	  function k2ik($uusrida, $uusveerg){
		  $nupp=$this->laud[$this->aktiivserida][$this->aktiivseveerg];
      if($nupp == "m" && $this->viimaneNupp == "v" && $this->aktiivserida - $uusrida == 1 &&
        ($this->aktiivseveerg - $uusveerg == 1 || $this->aktiivseveerg - $uusveerg == -1)){
            $this->laud[$uusrida][$uusveerg]=$nupp;
            //echo $uusrida, $uusveerg, $nupp;
            $this->laud[$this->aktiivserida][$this->aktiivseveerg]="r";
            $this->aktiivserida=-1;
            $this->aktiivseveerg=-1;
      }else if ($nupp == "v" && $this->viimaneNupp == "m" && $this->aktiivserida - $uusrida == -1 &&
         ($this->aktiivseveerg - $uusveerg == 1 || $this->aktiivseveerg - $uusveerg == -1)){
            $this->laud[$uusrida][$uusveerg]=$nupp;
            //echo $uusrida, $uusveerg, $nupp;
            $this->laud[$this->aktiivserida][$this->aktiivseveerg]="r";
            $this->aktiivserida=-1;
            $this->aktiivseveerg=-1;
      }else{
        $this->aktiivserida=-1;
        $this->aktiivseveerg=-1;
      }
      if($nupp != "r"){
        $this->viimaneNupp=$nupp;
      }
		  //Pange tööle ja hoolitsege, et mustad saaksid käia ainult diagonaalis edasi
	  }
	  function t88tleURL(){
 	   if(isSet($_REQUEST["rida"])){
 	     if($this->aktiivserida==-1){
			  $this->aktiivserida=intval($_REQUEST["rida"]);
			  $this->aktiivseveerg=intval($_REQUEST["veerg"]);
		 } else {
	      $uusrida=intval($_REQUEST["rida"]);
			  $uusveerg=intval($_REQUEST["veerg"]);
			  $this->k2ik($uusrida, $uusveerg);
		 }
		 $this->salvestaSessiooni();
	   }
	  }
	  function andmedTekstina(){
		  return json_encode(array(
		    "laud" => $this->laud,
			     "aktiivnekoht" => [$this->aktiivserida, $this->aktiivseveerg],
              "viimaneNupp" => $this->viimaneNupp));
	  }
	  function andmedTekstist($tekst){
		  $abi=json_decode($tekst);
		  $this->laud=$abi->laud;
		  $this->aktiivserida=$abi->aktiivnekoht[0];
		  $this->aktiivseveerg=$abi->aktiivnekoht[1];
      $this->viimaneNupp=$abi->viimaneNupp;
	  }
	  function salvestaSessiooni(){
		  $_SESSION["kabe"]=$this->andmedTekstina();
	  }
	  function loeSessioonist(){
		 if(isSet($_REQUEST["uusmang"])){unset($_SESSION["kabe"]);}
		 if(isSet($_SESSION["kabe"])){
		   $this->andmedTekstist($_SESSION["kabe"]);
		 }
	  }
  }
