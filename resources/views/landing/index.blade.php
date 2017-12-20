<?php
class DB
{
    protected $pdo;
    protected $table = 'city';
    protected $fetchMode = \PDO::FETCH_OBJ;
    public function __construct()
    {
        $config = [
                'db' =>[
//                        'database' => 'cp25654_citydb',
//                        'username' => 'cp25654_edr9',
//                        'password' => '9fbmH9$^_Ume'
                        'database' => 'landing_anif',
                        'username' => 'root',
                        'password' => ''
                ]
        ];
        try{
            $this->pdo = new \PDO("mysql:host=localhost;dbname={$config['db']['database']};charset=utf8",$config['db']['username'],$config['db']['password']);
        }catch (\Exception $e){
            die('Error : ' . $e->getMessage());
        }
    }
    public function select(){
        $statement = $this->pdo->prepare("SELECT `bot_username`,`name_fa`  FROM {$this->table} ORDER BY id ASC;");
        $statement->execute();
        return $statement->fetchAll(2);
    }
}

function myOld($field){
    return isset($_GET[$field]) ? $_GET[$field] : "" ;
}

$db = new DB();
$sellers = $db->select();
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>آنیف</title>
    <meta charset="utf-8" property="og:title" content="آنیف" />
    <meta charset="utf-8" property="og:site_name" content="آنیف"/>
    <meta charset="utf-8" property="og:description" content="آنیف | ربات تلگرام سفارش آنلاین غذا و باشگاه مشتریان" />
    <meta charset="utf-8" name="description" content="آنیف | ربات تلگرام سفارش آنلاین غذا و باشگاه مشتریان" />
    <meta charset="utf-8" property="og:image" content="img/ologo.png" />
    <meta charset="utf-8" name="keywords" content="آنیف بات,تخفیف,کوپن,خرید گروهی,تخفیف گروهی,آنیف,anif" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="tsiFpDoGqvQpTSRK0w9Dcqn_ZxriefVOZoXeXgbYmGg" />
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- IE -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <!-- other browsers -->
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta charset="utf-8" name="Robots" content="index,follow" />
    <link rel="stylesheet" href="/css/landing.css">

</head>
<body>
<h1 class="anifhead">آنیف</h1>
<h2 style="display:none">آنیف</h2>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <img class="logo img-responsive" src="/img/ologo.png" alt="آنیف">
        </div>
    </div>
    <div class="row navar">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="progress">
                <span>پیشرفت سایت</span>
                <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                    70%
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
            <div class="margin-auto">
                <h2 class="black">سفارش غذا از طریق ربات تلگرام آنیف</h2>
                <div class="animated bounce infinite">
                    <a href="#" class="fa fa-angle-down" aria-hidden="true"></a>
                </div>
                <a type="button" class="btn btn-success anif-btn" href="<?= 'http://telegram.me/' . myOld('bot_username') ?>" target="_blank">ربات آنیف</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <!-- Large modal -->
            <!--                <button type="button" class="btn btn-primary modalBtn" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>-->
            <div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content" style="text-align: center;padding: 35px 0;">
                        <h2 style="margin-bottom: 20px;">لطفا شهر مورد نظر خود را انتخاب کنید</h2>
                        <form class="form-horizontal" method="get">

                            <div class="col-xs-12 col-sm-9" style="float:right">
                                <select name="bot_username" class="form-control" style="direction: rtl;height: 50px;font-size: 20px;">
                                    <?php
                                    foreach ($sellers as $seller)
                                        echo "<option value='{$seller['bot_username']}'>{$seller['name_fa']}</option>".PHP_EOL;
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-3 zbtn" style="float:right;">
                                <button style="font-size: 20px;padding: 10px 40px;" type="submit" class="btn btn-success zzbtn">انتخاب شهر</button>
                            </div>
                            <div class="row">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/landing.js"></script>
<script>
            <?php
            if(!isset($_GET['bot_username'])){
                echo "$('#myModal').modal();";
            }
            ?>
    var h = $(document).height();
    var he = $('.modal-content').height();
    var element = $('#myModal');
    var modalbg = $('.modal-backdrop');
    modalbg.click(function (e) {
        e.preventDefault();
        var body = $('body');
        body.addClass("");
        body.addClass("modal-open");
        body.css("padding-right","17px");
    });
    element.css({"top":(h/2)-(he)});
</script>
</body>
</html>