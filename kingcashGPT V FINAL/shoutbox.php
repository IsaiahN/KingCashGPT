<?php

/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!                    
/***************************/

/************************
    CONSTANTS
/************************/
define("HOST", "localhost");
define("USER", "kingcash_admin");
define("PASSWORD", "jomiks");
define("DB", "kingcash_gpt");

/************************
    FUNCTIONS
/************************/
function connect($db, $user, $password){
    $link = @mysql_connect($db, $user, $password);
    if (!$link)
        die("Could not connect: ".mysql_error());
    else{
        $db = mysql_select_db(DB);
        if(!$db)
            die("Could not select database: ".mysql_error());
        else return $link;
    }
}
function getContent($link, $num){
    $res = @mysql_query("SELECT DATE_FORMAT( `date` , '%c/%e/%y %l:%i %p' ) as date2, id, user, message FROM shoutbox ORDER BY id DESC LIMIT ".$num, $link);
    if(!$res)
        die("Error: ".mysql_error());
    else
return $res;

}
function insertMessage($user, $message){

    $query = sechof("INSERT INTO shoutbox(user, message) VALUES('%s', '%s');", mysql_real_escape_string(strip_tags($user)), mysql_real_escape_string(strip_tags($message)));
    $res = @mysql_query($query);
    if(!$res)
        die("Error: ".mysql_error());
    else
        return $res;
}

/******************************
    MANAGE REQUESTS
/******************************/
if(!$_POST['action']){
    //We are redirecting people to our shoutbox page if they try to enter in our shoutbox.php
   header ("Location: index.php"); 
}
else{
    $link = connect(HOST, USER, PASSWORD);


    switch($_POST['action']){
        case "update":
            $res = getContent($link, 25);

$shouts = array();

global $userinfo;
while($row = mysql_fetch_assoc($res))
  $shouts[] = $row;
$shouts = array_reverse($shouts);

foreach($shouts as $shout) {
  $message = $shout['message'];
  $message = stripslashes($message);
$patterns = array();


// smilies
$patterns[0] = '/:\)/';
$patterns[1] = '/:o/';
$patterns[2] = '/:O/';
$patterns[3] = '/:\(/';
$patterns[4] = '/:\/\/\/d/';
$patterns[5] = '/:>/';
$patterns[6] = '/:</';
$patterns[7] = '/:lol:/';
$patterns[10] = '/;\)/';
$patterns[11] = '/:P/';
$patterns[12] = '/:D/';
$patterns[16] = '/:\$/';
$patterns[17] = '/:S/';
$patterns[19] = '/:\?/';
$patterns[22] = '/:ttyl:/';
$patterns[24] = '/:cool:/';
$patterns[25] = '/:smart:/';
$patterns[26] = '/:plz:/';
$patterns[28] = '/:huh:/';
$patterns[29] = '/:crazy:/';

// even more smilies: 
$patterns[221] = '/:221:/';
$patterns[222] = '/:222:/';
$patterns[223] = '/:223:/';
$patterns[224] = '/:224:/';
$patterns[225] = '/:225:/';
$patterns[226] = '/:226:/';
$patterns[227] = '/:227:/';
$patterns[228] = '/:228:/';
$patterns[229] = '/:229:/';
$patterns[2210] = '/:2210:/';
$patterns[2211] = '/:2211:/';
$patterns[2212] = '/:2212:/';
$patterns[2213] = '/:2213:/';
$patterns[2214] = '/:2214:/';
$patterns[2215] = '/:2215:/';
$patterns[2216] = '/:2216:/';
$patterns[2217] = '/:2217:/';
$patterns[2218] = '/:2218:/';
$patterns[2219] = '/:2219:/';
$patterns[2220] = '/:2220:/';
$patterns[2221] = '/:2221:/';
$patterns[2222] = '/:2222:/';
$patterns[2223] = '/:2223:/';
$patterns[2224] = '/:2224:/';
$patterns[2225] = '/:2225:/';
$patterns[2226] = '/:2226:/';
$patterns[2227] = '/:2227:/';
$patterns[2228] = '/:2228:/';
$patterns[2229] = '/:2229:/';
$patterns[2230] = '/:2230:/';
$patterns[2231] = '/:2231:/';
$patterns[2232] = '/:2232:/';
$patterns[2233] = '/:2233:/';
$patterns[2234] = '/:2234:/';
$patterns[2235] = '/:2235:/';
$patterns[2236] = '/:2236:/';
$patterns[2237] = '/:2237:/';
$patterns[2238] = '/:2238:/';
$patterns[2239] = '/:2239:/';
$patterns[2240] = '/:2240:/';
$patterns[2241] = '/:2241:/';
$patterns[2242] = '/:2242:/';
$patterns[2243] = '/:2243:/';
$patterns[2244] = '/:2244:/';
$patterns[2245] = '/:2245:/';
$patterns[2246] = '/:2246:/';
$patterns[2247] = '/:2247:/';
$patterns[2248] = '/:2248:/';
$patterns[2249] = '/:2249:/';
$patterns[2250] = '/:2250:/';
$patterns[2251] = '/:2251:/';
$patterns[2252] = '/:2252:/';
$patterns[2253] = '/:2253:/';
$patterns[2254] = '/:2254:/';
$patterns[2255] = '/:2255:/';
$patterns[2256] = '/:2256:/';
$patterns[2257] = '/:2257:/';
$patterns[2258] = '/:2258:/';
$patterns[2259] = '/:2259:/';
$patterns[2260] = '/:2260:/';
$patterns[2261] = '/:2261:/';
$patterns[2262] = '/:2262:/';
$patterns[2263] = '/:2263:/';
$patterns[2264] = '/:2264:/';
$patterns[2265] = '/:2265:/';
$patterns[2266] = '/:2266:/';
$patterns[2267] = '/:2267:/';
$patterns[2268] = '/:2268:/';
$patterns[2269] = '/:2269:/';
$patterns[2270] = '/:2270:/';
$patterns[2271] = '/:2271:/';
$patterns[2272] = '/:2272:/';
$patterns[2273] = '/:2273:/';
$patterns[2274] = '/:2274:/';
$patterns[2275] = '/:2275:/';
$patterns[2276] = '/:2276:/';
$patterns[2277] = '/:2277:/';
$patterns[2278] = '/:2278:/';
$patterns[2279] = '/:2279:/';
$patterns[2280] = '/:2280:/';
$patterns[2281] = '/:2281:/';
$patterns[2282] = '/:2282:/';
$patterns[2283] = '/:2283:/';
$patterns[2284] = '/:2284:/';
$patterns[2285] = '/:2285:/';
$patterns[2286] = '/:2286:/';
$patterns[2287] = '/:2287:/';
$patterns[2288] = '/:2288:/';
$patterns[2289] = '/:2289:/';
$patterns[2290] = '/:2290:/';
$patterns[2291] = '/:2291:/';
$patterns[2292] = '/:2292:/';
$patterns[2293] = '/:2293:/';
$patterns[2294] = '/:2294:/';
$patterns[2295] = '/:2295:/';
$patterns[2296] = '/:2296:/';
$patterns[2297] = '/:2297:/';
$patterns[2298] = '/:2298:/';
$patterns[2299] = '/:2299:/';
$patterns[22100] = '/:22100:/';
$patterns[22101] = '/:22101:/';
$patterns[22102] = '/:22102:/';
$patterns[22103] = '/:22103:/';
$patterns[22104] = '/:22104:/';
$patterns[22105] = '/:22105:/';
$patterns[22106] = '/:22106:/';
$patterns[22107] = '/:22107:/';
$patterns[22108] = '/:22108:/';
$patterns[22109] = '/:22109:/';
$patterns[22110] = '/:22110:/';
$patterns[22111] = '/:22111:/';
$patterns[22112] = '/:22112:/';
$patterns[22113] = '/:22113:/';
$patterns[22114] = '/:22114:/';
$patterns[22115] = '/:22115:/';
$patterns[22116] = '/:22116:/';
$patterns[22117] = '/:22117:/';
$patterns[22118] = '/:22118:/';
$patterns[22119] = '/:22119:/';
$patterns[22120] = '/:22120:/';
$patterns[22121] = '/:22121:/';
$patterns[22122] = '/:22122:/';
$patterns[22123] = '/:22123:/';
$patterns[22124] = '/:22124:/';
$patterns[22125] = '/:22125:/';
$patterns[22126] = '/:22126:/';
$patterns[22127] = '/:22127:/';
$patterns[22128] = '/:22128:/';
$patterns[22129] = '/:22129:/';
$patterns[22130] = '/:22130:/';
$patterns[22131] = '/:22131:/';
$patterns[22132] = '/:22132:/';
$patterns[22133] = '/:22133:/';
$patterns[22134] = '/:22134:/';
$patterns[22135] = '/:22135:/';
$patterns[22136] = '/:22136:/';
$patterns[22137] = '/:22137:/';
$patterns[22138] = '/:22138:/';
$patterns[22139] = '/:22139:/';
$patterns[22140] = '/:22140:/';
$patterns[22141] = '/:22141:/';
$patterns[22142] = '/:22142:/';
$patterns[22143] = '/:22143:/';
$patterns[22144] = '/:22144:/';
$patterns[22145] = '/:22145:/';
$patterns[22146] = '/:22146:/';
$patterns[22147] = '/:22147:/';
$patterns[22148] = '/:22148:/';
$patterns[22149] = '/:22149:/';
$patterns[22150] = '/:22150:/';
$patterns[22151] = '/:22151:/';
$patterns[22152] = '/:22152:/';
$patterns[22153] = '/:22153:/';
$patterns[22154] = '/:22154:/';
$patterns[22155] = '/:22155:/';
$patterns[22156] = '/:22156:/';
$patterns[22157] = '/:22157:/';
$patterns[22158] = '/:22158:/';
$patterns[22159] = '/:22159:/';
$patterns[22160] = '/:22160:/';
$patterns[22161] = '/:22161:/';
$patterns[22162] = '/:22162:/';
$patterns[22163] = '/:22163:/';
$patterns[22164] = '/:22164:/';
$patterns[22165] = '/:22165:/';
$patterns[22166] = '/:22166:/';
$patterns[22167] = '/:22167:/';
$patterns[22168] = '/:22168:/';
$patterns[22169] = '/:22169:/';

// curse words:
$patterns[30] = '/fuck/';
$patterns[31] = '/Fuck/';
$patterns[32] = '/FUCK/';
$patterns[33] = '/FuCk/';
$patterns[34] = '/fuCk/';
$patterns[35] = '/bitch/';
$patterns[36] = '/BiTcH/';
$patterns[37] = '/shit/';
$patterns[38] = '/motherfuck/';
$patterns[39] = '/cunt/';
$patterns[40] = '/CUNT/';
$patterns[41] = '/pussy/';
$patterns[42] = '/PUSSY/';
$patterns[43] = '/CUM/';
$patterns[44] = '/DICK/';
$patterns[45] = '/cum/';
$patterns[46] = '/dick/';
$patterns[47] = '/penis/';
$patterns[48] = '/dam/';
$patterns[49] = '/tits/';
$patterns[50] = '/TITS/';
$patterns[51] = '/cock/';
$patterns[52] = '/ass/';
$patterns[53] = '/ASS/';



$replacements = array();

// smilies
$replacements[0] = '<img src="images/emoticons/m009.gif" alt="emoticon"/>';
$replacements[1] = '<img src="images/emoticons/m071.gif" alt="emoticon"/>';
$replacements[2] = '<img src="images/emoticons/m077.gif" alt="emoticon"/>';
$replacements[3] = '<img src="images/emoticons/m147.gif" alt="emoticon"/>';
$replacements[4] = '<img src="images/emoticons/m021.gif" alt="emoticon"/>';
$replacements[5] = '<img src="images/emoticons/m129.gif" alt="emoticon"/>';
$replacements[6] = '<img src="images/emoticons/m140.gif" alt="emoticon"/>';
$replacements[7] = '<img src="images/emoticons/m146.gif" alt="emoticon"/>';
$replacements[10] = '<img src="images/emoticons/m087.gif" alt="emoticon"/>';
$replacements[11] = '<img src="images/emoticons/m011.gif" alt="emoticon"/>';
$replacements[12] = '<img src="images/emoticons/m121.gif" alt="emoticon"/>';
$replacements[16] = '<img src="images/emoticons/m186.gif" alt="emoticon"/>';
$replacements[17] = '<img src="images/emoticons/m097.gif" alt="emoticon"/>';
$replacements[19] = '<img src="images/emoticons/m075.gif" alt="emoticon"/>';
$replacements[22] = '<img src="images/emoticons/m118.gif" alt="emoticon"/>';
$replacements[24] = '<img src="images/emoticons/m114.gif" alt="emoticon"/>';
$replacements[25] = '<img src="images/emoticons/m123.gif" alt="emoticon"/>';
$replacements[26] = '<img src="images/emoticons/m107.gif" alt="emoticon"/>';
$replacements[28] = '<img src="images/emoticons/m075.gif" alt="emoticon"/>';
$replacements[29] = '<img src="images/emoticons/m179.gif" alt="emoticon"/>';


//even more smillies replaced
$replacements[221] = '<img src="images/emoticons/001.gif" alt="emoticon"/>';
$replacements[222] = '<img src="images/emoticons/002.gif" alt="emoticon"/>';
$replacements[223] = '<img src="images/emoticons/003.gif" alt="emoticon"/>';
$replacements[224] = '<img src="images/emoticons/004.gif" alt="emoticon"/>';
$replacements[225] = '<img src="images/emoticons/005.gif" alt="emoticon"/>';
$replacements[226] = '<img src="images/emoticons/006.gif" alt="emoticon"/>';
$replacements[227] = '<img src="images/emoticons/007.gif" alt="emoticon"/>';
$replacements[228] = '<img src="images/emoticons/008.gif" alt="emoticon"/>';
$replacements[229] = '<img src="images/emoticons/009.gif" alt="emoticon"/>';
$replacements[2210] = '<img src="images/emoticons/010.gif" alt="emoticon"/>';
$replacements[2211] = '<img src="images/emoticons/011.gif" alt="emoticon"/>';
$replacements[2212] = '<img src="images/emoticons/012.gif" alt="emoticon"/>';
$replacements[2213] = '<img src="images/emoticons/013.gif" alt="emoticon"/>';
$replacements[2214] = '<img src="images/emoticons/014.gif" alt="emoticon"/>';
$replacements[2215] = '<img src="images/emoticons/015.gif" alt="emoticon"/>';
$replacements[2216] = '<img src="images/emoticons/016.gif" alt="emoticon"/>';
$replacements[2217] = '<img src="images/emoticons/017.gif" alt="emoticon"/>';
$replacements[2218] = '<img src="images/emoticons/018.gif" alt="emoticon"/>';
$replacements[2219] = '<img src="images/emoticons/019.gif" alt="emoticon"/>';
$replacements[2220] = '<img src="images/emoticons/020.gif" alt="emoticon"/>';
$replacements[2221] = '<img src="images/emoticons/021.gif" alt="emoticon"/>';
$replacements[2222] = '<img src="images/emoticons/022.gif" alt="emoticon"/>';
$replacements[2223] = '<img src="images/emoticons/023.gif" alt="emoticon"/>';
$replacements[2224] = '<img src="images/emoticons/024.gif" alt="emoticon"/>';
$replacements[2225] = '<img src="images/emoticons/025.gif" alt="emoticon"/>';
$replacements[2226] = '<img src="images/emoticons/026.gif" alt="emoticon"/>';
$replacements[2227] = '<img src="images/emoticons/027.gif" alt="emoticon"/>';
$replacements[2228] = '<img src="images/emoticons/028.gif" alt="emoticon"/>';
$replacements[2229] = '<img src="images/emoticons/029.gif" alt="emoticon"/>';
$replacements[2230] = '<img src="images/emoticons/030.gif" alt="emoticon"/>';
$replacements[2231] = '<img src="images/emoticons/031.gif" alt="emoticon"/>';
$replacements[2232] = '<img src="images/emoticons/032.gif" alt="emoticon"/>';
$replacements[2233] = '<img src="images/emoticons/033.gif" alt="emoticon"/>';
$replacements[2234] = '<img src="images/emoticons/034.gif" alt="emoticon"/>';
$replacements[2235] = '<img src="images/emoticons/035.gif" alt="emoticon"/>';
$replacements[2236] = '<img src="images/emoticons/036.gif" alt="emoticon"/>';
$replacements[2237] = '<img src="images/emoticons/037.gif" alt="emoticon"/>';
$replacements[2238] = '<img src="images/emoticons/038.gif" alt="emoticon"/>';
$replacements[2239] = '<img src="images/emoticons/039.gif" alt="emoticon"/>';
$replacements[2240] = '<img src="images/emoticons/040.gif" alt="emoticon"/>';
$replacements[2241] = '<img src="images/emoticons/041.gif" alt="emoticon"/>';
$replacements[2242] = '<img src="images/emoticons/042.gif" alt="emoticon"/>';
$replacements[2243] = '<img src="images/emoticons/043.gif" alt="emoticon"/>';
$replacements[2244] = '<img src="images/emoticons/044.gif" alt="emoticon"/>';
$replacements[2245] = '<img src="images/emoticons/045.gif" alt="emoticon"/>';
$replacements[2246] = '<img src="images/emoticons/046.gif" alt="emoticon"/>';
$replacements[2247] = '<img src="images/emoticons/047.gif" alt="emoticon"/>';
$replacements[2248] = '<img src="images/emoticons/048.gif" alt="emoticon"/>';
$replacements[2249] = '<img src="images/emoticons/049.gif" alt="emoticon"/>';
$replacements[2250] = '<img src="images/emoticons/050.gif" alt="emoticon"/>';
$replacements[2251] = '<img src="images/emoticons/051.gif" alt="emoticon"/>';
$replacements[2252] = '<img src="images/emoticons/052.gif" alt="emoticon"/>';
$replacements[2253] = '<img src="images/emoticons/053.gif" alt="emoticon"/>';
$replacements[2254] = '<img src="images/emoticons/054.gif" alt="emoticon"/>';
$replacements[2255] = '<img src="images/emoticons/055.gif" alt="emoticon"/>';
$replacements[2256] = '<img src="images/emoticons/056.gif" alt="emoticon"/>';
$replacements[2257] = '<img src="images/emoticons/057.gif" alt="emoticon"/>';
$replacements[2258] = '<img src="images/emoticons/058.gif" alt="emoticon"/>';
$replacements[2259] = '<img src="images/emoticons/059.gif" alt="emoticon"/>';
$replacements[2260] = '<img src="images/emoticons/060.gif" alt="emoticon"/>';
$replacements[2261] = '<img src="images/emoticons/061.gif" alt="emoticon"/>';
$replacements[2262] = '<img src="images/emoticons/062.gif" alt="emoticon"/>';
$replacements[2263] = '<img src="images/emoticons/063.gif" alt="emoticon"/>';
$replacements[2264] = '<img src="images/emoticons/064.gif" alt="emoticon"/>';
$replacements[2265] = '<img src="images/emoticons/065.gif" alt="emoticon"/>';
$replacements[2266] = '<img src="images/emoticons/066.gif" alt="emoticon"/>';
$replacements[2267] = '<img src="images/emoticons/067.gif" alt="emoticon"/>';
$replacements[2268] = '<img src="images/emoticons/068.gif" alt="emoticon"/>';
$replacements[2269] = '<img src="images/emoticons/069.gif" alt="emoticon"/>';
$replacements[2270] = '<img src="images/emoticons/070.gif" alt="emoticon"/>';
$replacements[2271] = '<img src="images/emoticons/071.gif" alt="emoticon"/>';
$replacements[2272] = '<img src="images/emoticons/072.gif" alt="emoticon"/>';
$replacements[2273] = '<img src="images/emoticons/073.gif" alt="emoticon"/>';
$replacements[2274] = '<img src="images/emoticons/074.gif" alt="emoticon"/>';
$replacements[2275] = '<img src="images/emoticons/075.gif" alt="emoticon"/>';
$replacements[2276] = '<img src="images/emoticons/076.gif" alt="emoticon"/>';
$replacements[2277] = '<img src="images/emoticons/077.gif" alt="emoticon"/>';
$replacements[2278] = '<img src="images/emoticons/078.gif" alt="emoticon"/>';
$replacements[2279] = '<img src="images/emoticons/079.gif" alt="emoticon"/>';
$replacements[2280] = '<img src="images/emoticons/080.gif" alt="emoticon"/>';
$replacements[2281] = '<img src="images/emoticons/081.gif" alt="emoticon"/>';
$replacements[2282] = '<img src="images/emoticons/082.gif" alt="emoticon"/>';
$replacements[2283] = '<img src="images/emoticons/083.gif" alt="emoticon"/>';
$replacements[2284] = '<img src="images/emoticons/084.gif" alt="emoticon"/>';
$replacements[2285] = '<img src="images/emoticons/085.gif" alt="emoticon"/>';
$replacements[2286] = '<img src="images/emoticons/086.gif" alt="emoticon"/>';
$replacements[2287] = '<img src="images/emoticons/087.gif" alt="emoticon"/>';
$replacements[2288] = '<img src="images/emoticons/088.gif" alt="emoticon"/>';
$replacements[2289] = '<img src="images/emoticons/089.gif" alt="emoticon"/>';
$replacements[2290] = '<img src="images/emoticons/090.gif" alt="emoticon"/>';
$replacements[2291] = '<img src="images/emoticons/091.gif" alt="emoticon"/>';
$replacements[2292] = '<img src="images/emoticons/092.gif" alt="emoticon"/>';
$replacements[2293] = '<img src="images/emoticons/093.gif" alt="emoticon"/>';
$replacements[2294] = '<img src="images/emoticons/094.gif" alt="emoticon"/>';
$replacements[2295] = '<img src="images/emoticons/095.gif" alt="emoticon"/>';
$replacements[2296] = '<img src="images/emoticons/096.gif" alt="emoticon"/>';
$replacements[2297] = '<img src="images/emoticons/097.gif" alt="emoticon"/>';
$replacements[2298] = '<img src="images/emoticons/098.gif" alt="emoticon"/>';
$replacements[2299] = '<img src="images/emoticons/099.gif" alt="emoticon"/>';
$replacements[22100] = '<img src="images/emoticons/100.gif" alt="emoticon"/>';
$replacements[22101] = '<img src="images/emoticons/101.gif" alt="emoticon"/>';
$replacements[22102] = '<img src="images/emoticons/102.gif" alt="emoticon"/>';
$replacements[22103] = '<img src="images/emoticons/103.gif" alt="emoticon"/>';
$replacements[22104] = '<img src="images/emoticons/104.gif" alt="emoticon"/>';
$replacements[22105] = '<img src="images/emoticons/105.gif" alt="emoticon"/>';
$replacements[22106] = '<img src="images/emoticons/106.gif" alt="emoticon"/>';
$replacements[22107] = '<img src="images/emoticons/107.gif" alt="emoticon"/>';
$replacements[22108] = '<img src="images/emoticons/108.gif" alt="emoticon"/>';
$replacements[22109] = '<img src="images/emoticons/109.gif" alt="emoticon"/>';
$replacements[22110] = '<img src="images/emoticons/110.gif" alt="emoticon"/>';
$replacements[22111] = '<img src="images/emoticons/111.gif" alt="emoticon"/>';
$replacements[22112] = '<img src="images/emoticons/112.gif" alt="emoticon"/>';
$replacements[22113] = '<img src="images/emoticons/113.gif" alt="emoticon"/>';
$replacements[22114] = '<img src="images/emoticons/114.gif" alt="emoticon"/>';
$replacements[22115] = '<img src="images/emoticons/115.gif" alt="emoticon"/>';
$replacements[22116] = '<img src="images/emoticons/116.gif" alt="emoticon"/>';
$replacements[22117] = '<img src="images/emoticons/117.gif" alt="emoticon"/>';
$replacements[22118] = '<img src="images/emoticons/118.gif" alt="emoticon"/>';
$replacements[22119] = '<img src="images/emoticons/119.gif" alt="emoticon"/>';
$replacements[22120] = '<img src="images/emoticons/120.gif" alt="emoticon"/>';
$replacements[22121] = '<img src="images/emoticons/121.gif" alt="emoticon"/>';
$replacements[22122] = '<img src="images/emoticons/122.gif" alt="emoticon"/>';
$replacements[22123] = '<img src="images/emoticons/123.gif" alt="emoticon"/>';
$replacements[22124] = '<img src="images/emoticons/124.gif" alt="emoticon"/>';
$replacements[22125] = '<img src="images/emoticons/125.gif" alt="emoticon"/>';
$replacements[22126] = '<img src="images/emoticons/126.gif" alt="emoticon"/>';
$replacements[22127] = '<img src="images/emoticons/127.gif" alt="emoticon"/>';
$replacements[22128] = '<img src="images/emoticons/128.gif" alt="emoticon"/>';
$replacements[22129] = '<img src="images/emoticons/129.gif" alt="emoticon"/>';
$replacements[22130] = '<img src="images/emoticons/130.gif" alt="emoticon"/>';
$replacements[22131] = '<img src="images/emoticons/131.gif" alt="emoticon"/>';
$replacements[22132] = '<img src="images/emoticons/132.gif" alt="emoticon"/>';
$replacements[22133] = '<img src="images/emoticons/133.gif" alt="emoticon"/>';
$replacements[22134] = '<img src="images/emoticons/134.gif" alt="emoticon"/>';
$replacements[22135] = '<img src="images/emoticons/135.gif" alt="emoticon"/>';
$replacements[22136] = '<img src="images/emoticons/136.gif" alt="emoticon"/>';
$replacements[22137] = '<img src="images/emoticons/137.gif" alt="emoticon"/>';
$replacements[22138] = '<img src="images/emoticons/138.gif" alt="emoticon"/>';
$replacements[22139] = '<img src="images/emoticons/139.gif" alt="emoticon"/>';
$replacements[22140] = '<img src="images/emoticons/140.gif" alt="emoticon"/>';
$replacements[22141] = '<img src="images/emoticons/141.gif" alt="emoticon"/>';
$replacements[22142] = '<img src="images/emoticons/142.gif" alt="emoticon"/>';
$replacements[22143] = '<img src="images/emoticons/143.gif" alt="emoticon"/>';
$replacements[22144] = '<img src="images/emoticons/144.gif" alt="emoticon"/>';
$replacements[22145] = '<img src="images/emoticons/145.gif" alt="emoticon"/>';
$replacements[22146] = '<img src="images/emoticons/146.gif" alt="emoticon"/>';
$replacements[22147] = '<img src="images/emoticons/147.gif" alt="emoticon"/>';
$replacements[22148] = '<img src="images/emoticons/148.gif" alt="emoticon"/>';
$replacements[22149] = '<img src="images/emoticons/149.gif" alt="emoticon"/>';
$replacements[22150] = '<img src="images/emoticons/150.gif" alt="emoticon"/>';
$replacements[22151] = '<img src="images/emoticons/151.gif" alt="emoticon"/>';
$replacements[22152] = '<img src="images/emoticons/152.gif" alt="emoticon"/>';
$replacements[22153] = '<img src="images/emoticons/153.gif" alt="emoticon"/>';
$replacements[22154] = '<img src="images/emoticons/154.gif" alt="emoticon"/>';
$replacements[22155] = '<img src="images/emoticons/155.gif" alt="emoticon"/>';
$replacements[22156] = '<img src="images/emoticons/156.gif" alt="emoticon"/>';
$replacements[22157] = '<img src="images/emoticons/157.gif" alt="emoticon"/>';
$replacements[22158] = '<img src="images/emoticons/158.gif" alt="emoticon"/>';
$replacements[22159] = '<img src="images/emoticons/159.gif" alt="emoticon"/>';
$replacements[22160] = '<img src="images/emoticons/160.gif" alt="emoticon"/>';
$replacements[22161] = '<img src="images/emoticons/161.gif" alt="emoticon"/>';
$replacements[22162] = '<img src="images/emoticons/162.gif" alt="emoticon"/>';
$replacements[22163] = '<img src="images/emoticons/163.gif" alt="emoticon"/>';
$replacements[22164] = '<img src="images/emoticons/164.gif" alt="emoticon"/>';
$replacements[22165] = '<img src="images/emoticons/165.gif" alt="emoticon"/>';
$replacements[22166] = '<img src="images/emoticons/166.gif" alt="emoticon"/>';
$replacements[22167] = '<img src="images/emoticons/167.gif" alt="emoticon"/>';
$replacements[22168] = '<img src="images/emoticons/168.gif" alt="emoticon"/>';
$replacements[22169] = '<img src="images/emoticons/169.gif" alt="emoticon"/>';



// curse words replaced

$replacements[30] = '****';
$replacements[31] = '****';
$replacements[32] = '****';
$replacements[33] = '****';
$replacements[34] = '****';
$replacements[35] = '*****';
$replacements[36] = '*****';
$replacements[37] = '****';
$replacements[38] = 'motherlov';
$replacements[39] = '****';
$replacements[40] = '****';
$replacements[41] = '*****';
$replacements[42] = '*****';
$replacements[43] = '***';
$replacements[44] = '****';
$replacements[45] = '***';
$replacements[46] = '****';
$replacements[47] = '*****';
$replacements[48] = '***';
$replacements[49] = '****';
$replacements[50] = '****';
$replacements[51] = '****';
$replacements[52] = '***';
$replacements[53] = '***';

ksort($patterns);
ksort($replacements);
$message = preg_replace($patterns, $replacements, $message);

	                
	            $date2 = $shout['date2'];
		
		                  if ($shout['user'] == "admin"){
		                  $result .= "<li id=\"adminchatuser\"><span class=\"date\">".$date2."</span><span class=\"shoutboxuser\" id=\"adminchatuser\"><img src=\"images/bot.png\" alt=\"\" />KCGPT Admin:</span><span class=\"shoutboxmessage\">".$message."</span> </li>";
		
		                  }else  if ($shout['user'] == "ArticMonkey"){
		                  $result .= "<li id=\"modchatuser\"><span class=\"date\">".$date2."</span><span class=\"shoutboxuser\" id=\"modchatuser\">[MOD] ".$shout['user'].":</span><span class=\"shoutboxmessage\">".$message."</span> </li>";
		
		                  }else  if ($shout['user'] == "Engetsu"){
		                  $result .= "<li id=\"modchatuser2\"><span class=\"date\">".$date2."</span><span class=\"shoutboxuser\" id=\"modchatuser2\">[MOD] ".$shout['user'].":</span><span class=\"shoutboxmessage\">".$message."</span> </li>";
		
		                  }else  if ($shout['user'] == "cooperxx22"){
		                  $result .= "<li id=\"aidchatuser\"><span class=\"date\">".$date2."</span><span class=\"shoutboxuser\" id=\"aidchatuser\">[Duke] ".$shout['user'].":</span><span class=\"shoutboxmessage\">".$message."</span> </li>";
		
		                  } else{
		
		                $result .= "<li><span class=\"date\">".$date2."</span><span class=\"shoutboxuser\">".$shout['user'].":</span><span class=\"shoutboxmessage\">".$message."</span> </li>";   
	            
	         }
          
            }
            echo $result;
            break;
        case "insert":
            echo insertMessage($_POST['nick'], $_POST['message']);
            break;
    }
    mysql_close($link);
}


?> 