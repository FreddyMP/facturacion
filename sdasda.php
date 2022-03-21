<?php//plugin para mostrar mapa de Google

putParamView("constructDatagrid","0");
putParamView("showDatagrid","0");

$latitud="18.4800424";
$longitud="-69.9468799";

if ($_POST['filter_Code_User']!=''){
$Code_User="('".$_POST['filter_Code_User']."')";
$Code_User=str_replace(',',"','",$Code_User);
$cond_sql="where view_last_users_geolocation.Code_User in ".$Code_User;
}else if (getFilter('view_last_users_geolocation','Code_User')!=''){
$Code_User="('".getFilter('view_last_users_geolocation','Code_User')."')";
$Code_User=str_replace(',',"','",$Code_User);
$cond_sql="where view_last_users_geolocation.Code_User in ".$Code_User;
}else{
$Code_User='';
$cond_sql="where view_last_users_geolocation.Code_User = '".$Code_User."'";
}

$sql="select view_last_users_geolocation.Code_User,a.Name1, view_last_users_geolocation.Date_Captured, view_last_users_geolocation.Hour_Captured, view_last_users_geolocation.Latitude, view_last_users_geolocation.Length from view_last_users_geolocation join account a on a.code = view_last_users_geolocation.Code_Account  where  ".$cond_sql." ";
$results=getFromSQL($sql);
if (count($results) > 0) {
$latitud=str_replace(",",".",$results[0]['LATITUDE']);
$longitud=str_replace(",",".",$results[0]['LENGTH']);
}

$js='var puntos=[];';
$js.='function initialize() {';
$js.='initialize_gmaps('.$latitud.', '.$longitud.', "map_canvas",10);';
$js.='content="";
icon_type="own";
icon="";
code="";
estado="";';

$puntos_aux=array();
$puntos=array();
$puntos_vis=array();
$i=0;
for($j=0;$j<count($results);$j++) {
$latitud=$results[$j]['LATITUDE'];
$longitud=$results[$j]['LENGTH'];
$fecha=$results[$j]['DATE_CAPTURED'];
$fecha=substr($fecha, 6,2)."-".substr($fecha, 4,2)."-".substr($fecha, 0,4);
$hora=$results[$j]['HOUR_CAPTURED'];
$hora=substr($hora, 0,2).":".substr($hora, 2,2);//.":".substr($hora, 4,2);
$code_user=$results[$j]['CODE_USER'];

$sql="select Description as ".escaparColumnaSQL("User")." from core_users where Code='".$code_user."'";

$results2=getFromSQL($sql);
$vendedor = $results2[0]['USER'];
$sql3="select top 1 a.Name1, v.code, vv.Code_Entity from visits_cap v 
inner join accounts a on a.Code = v.Code_Account
inner join view_visits_entities_actions vv on vv.Code_Visit = v.Code
where v.Code_Seller = '$vendedor'  order by v.Date_Captured desc";
$results3=getFromSQL($sql3);
$cliente = $results3[0]['Name'];
$texto=$fecha.' '.$hora.'. '.$vendedor.'. '.$cliente;

if (count($puntos_aux)>0){
$punto_anterior=$puntos_aux[count($puntos_aux) - 1];
if ($punto_anterior['latitud']!=$latitud||$punto_anterior['longitud']!=$longitud){
$hito=$punto_anterior['i']+1;
$latitud_reducida=substr($latitud,0,stripos($latitud,'.'));
$latitud_reducida.=substr($latitud,stripos($latitud,'.')+1,2);
$longitud_reducida=substr($longitud,0,stripos($longitud,'.'));
$longitud_reducida.=substr($longitud,stripos($longitud,'.')+1,2);
if (isset($puntos_vis[$latitud_reducida][$longitud_reducida])){
if ($puntos_vis[$latitud_reducida][$longitud_reducida]['ultimo']!=($hito-1)){
$puntos_vis[$latitud_reducida][$longitud_reducida]['texto'].='<br>'.$texto;
$puntos_vis[$latitud_reducida][$longitud_reducida]['ultimo']=$hito;
$i_aux=$puntos_vis[$latitud_reducida][$longitud_reducida]['i'];
$texto_aux=$puntos_vis[$latitud_reducida][$longitud_reducida]['texto'];
$ultimo_aux=$puntos_vis[$latitud_reducida][$longitud_reducida]['ultimo'];
$latitud_aux=$puntos_vis[$latitud_reducida][$longitud_reducida]['latitud'];
$longitud_aux=$puntos_vis[$latitud_reducida][$longitud_reducida]['longitud'];
$multiple_aux="1";
$puntos_vis['oculto'.$hito][0]=array("latitud"=>$latitud_aux,"longitud"=>$longitud_aux,"i"=>$i_aux,"texto"=>$texto_aux,"ultimo"=>$ultimo_aux,"oculto"=>"1","latitud_ref"=>$latitud_reducida,"longitud_ref"=>$longitud_reducida,"orden"=>count($puntos));
$puntos[]=array("latitud"=>$latitud_aux,"longitud"=>$longitud_aux,"i"=>$i_aux,"texto"=>$texto_aux,"ultimo"=>$ultimo_aux,"oculto"=>"1","latitud_ref"=>$latitud_reducida,"longitud_ref"=>$longitud_reducida,"multiple"=>$multiple_aux,"code_user"=>$code_user);
}else{
$puntos_vis[$latitud_reducida][$longitud_reducida]['texto'].='<br>'.$texto;
$puntos_vis[$latitud_reducida][$longitud_reducida]['ultimo']=$hito;
$puntos[$puntos_vis[$latitud_reducida][$longitud_reducida]['orden']]['texto'].='<br>'.$texto;
$puntos[$puntos_vis[$latitud_reducida][$longitud_reducida]['orden']]['ultimo']=$hito;
$puntos[$puntos_vis[$latitud_reducida][$longitud_reducida]['orden']]['multiple']="1";
foreach ($puntos_vis as $key1 => $escalon1){
foreach ($escalon1 as $key2 => $item){
if (($item['ultimo']==($hito-1))&&($item['oculto']==1)){
$puntos_vis[$key1][$key2]['texto']=$puntos_vis[$latitud_reducida][$longitud_reducida]['texto'];
$puntos_vis[$key1][$key2]['ultimo']=$puntos_vis[$latitud_reducida][$longitud_reducida]['ultimo'];
$puntos[$puntos_vis[$key1][$key2]['orden']]['texto']=$puntos_vis[$latitud_reducida][$longitud_reducida]['texto'];
$puntos[$puntos_vis[$key1][$key2]['orden']]['ultimo']=$puntos_vis[$latitud_reducida][$longitud_reducida]['ultimo'];
}
}
}
}
}else{
$puntos_vis[$latitud_reducida][$longitud_reducida]=array("latitud"=>$latitud,"longitud"=>$longitud,"i"=>$hito,"texto"=>$texto,"ultimo"=>$hito,"orden"=>count($puntos));
$puntos[]=array("latitud"=>$latitud,"longitud"=>$longitud,"i"=>$hito,"texto"=>$texto,"ultimo"=>$hito,"multiple"=>"0","code_user"=>$code_user);
}
$puntos_aux[]=array("i"=>$hito,"latitud"=>$latitud,"longitud"=>$longitud);
}else{
$keys_puntos_vis=array_keys($puntos_vis);
$latitud_fin=array_pop($keys_puntos_vis);
$longitud_fin=array_pop(array_keys($puntos_vis[$latitud_fin]));
$puntos[$puntos_vis[$latitud_fin][$longitud_fin]['orden']]['texto'].='<br>'.$texto;
$puntos[$puntos_vis[$latitud_fin][$longitud_fin]['orden']]['multiple']='1';
}
}else{
$latitud_reducida=substr($latitud,0,stripos($latitud,'.'));
$latitud_reducida.=substr($latitud,stripos($latitud,'.')+1,2);
$longitud_reducida=substr($longitud,0,stripos($longitud,'.'));
$longitud_reducida.=substr($longitud,stripos($longitud,'.')+1,2);
$puntos_aux[]=array("i"=>$hito,"latitud"=>$latitud,"longitud"=>$longitud);
$puntos_vis[$latitud_reducida][$longitud_reducida]=array("latitud"=>$latitud,"longitud"=>$longitud,"i"=>$i,"texto"=>$texto,"ultimo"=>$i,"orden"=>$i);
$puntos[]=array("latitud"=>$latitud,"longitud"=>$longitud,"i"=>$i,"texto"=>$texto,"ultimo"=>$i,"multiple"=>"0","code_user"=>$code_user);
}
$i++;
}

for($i=0;$i<count($puntos);$i++){
$puntos[$i]['latitud']=str_replace(",",".",$puntos[$i]['latitud']);
$puntos[$i]['longitud']=str_replace(",",".",$puntos[$i]['longitud']);
$js.= "var puntos = new Array();puntos.push([".$puntos[$i]['latitud'].",".$puntos[$i]['longitud'].",'".$puntos[$i]['code_user']."', '".$puntos[$i]['texto']."', ".$puntos[$i]['multiple']."]);\n";
}

//javascript*******************************
$js.='var longitud = puntos.length;';
$js.='for (i=0;i<longitud;i++) {';
$js.='color=7;';
$js.='if (puntos[i][4] == 1 || puntos[i][4] == 2) color=3;';
$js.='placeMarkerSeller(map,puntos[i][0],puntos[i][1],puntos[i][2], puntos[i][3],i,"",false,true, "'.$GLOBALS['config_res_dir'].'/generateImage.php?text="+puntos[i][2]+"&color="+ color); ';
$js.='}';
//javascript*******************************

$js.='}';
$js.='initialize();';
if (count($results) > 0) {
printHtml('<div class="row" style="margin-left:0px;margin-right:0px;"><div class="col-lg-12" style="padding-right: 15px;padding-left: 15px;"><div class="card__title"><h4>ULTIMA POSICION</h4></div></div></div><div class="row" style="margin-left:0px;margin-right:0px;"><div class="col-lg-12" style="padding-right: 15px;padding-left: 15px;"><div class="card__body"><div id="map_canvas" style="height: 600px"></div></div></div></div>',$js);
}
else {
 printHtml('<div class="row" style="margin-left:0px;margin-right:0px;"><div class="col-lg-12" style="position: relative;width: 100%;padding-right: 15px;padding-left: 15px;"><div class="card__body" style="text-align:center;width:100%"><h1>Sin resultados</h1></div></div></div>');
}