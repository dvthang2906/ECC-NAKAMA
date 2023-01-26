/*
-- Create database
CREATE database thongtin;
Create USER nakama IDENTIFIED WITH MYSQL_NATIVE_PASSWORD BY 'ecc';
GRANT ALL ON thongtin.* TO nakama;
use thongtin;
*/
CREATE database Shop;
Create USER Shop IDENTIFIED WITH MYSQL_NATIVE_PASSWORD BY 'ecc';
GRANT ALL ON Shop.* TO Shop;
use Shop;

-- ロギング情報
    DROP TABLE IF EXISTS login_infomation;
    CREATE TABLE IF NOT EXISTS login_infomation(
        id          SMALLINT AUTO_INCREMENT,
        admin       INT(1) NOT NULL DEFAULT '0',
        user        VARCHAR(50) NOT NULL,
        password    VARCHAR(50) NOT NULL,
        email       TEXT NOT NULL,
        `created_time` int(11) NOT NULL,
        `last_updated` int(11) NOT NULL,
        PRIMARY KEY (id)
    );

    
    INSERT INTO `login_infomation` (`id`, `admin`, `user`, `password`, `email`, `created_time`, `last_updated`) 
    VALUES (NULL, '1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '1673716697', '1673716697'),
           (NULL, '0', 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@gmail.com', '1673716697', '1673716697');


-- 支払情報
    DROP TABLE IF EXISTS infomation;
    CREATE TABLE IF NOT EXISTS infomation(
        user_id SERIAL,
        user TEXT NOT NULL,
        name TEXT,
        tel BIGINT,
        address TEXT,
        gmail TEXT,
        time DATETIME NOT NULL
    );

    INSERT INTO infomation(`user`, `time`) VALUES ('test', '2023-01-26'),('admin', '2023-01-26');

-- 黄道帯
    DROP TABLE IF EXISTS koudoutai;
    CREATE TABLE IF NOT EXISTS koudoutai (
        id     SERIAL PRIMARY KEY,
        koudou_Name TEXT
    );

    INSERT INTO koudoutai(koudou_Name)
        VALUES
        ("白羊宮"),('金牛宮'),('双児宮'),('巨蟹宮'),
        ('獅子宮'),('処女宮'),('天秤宮'),('天蠍宮'),
        ('人馬宮'),('磨羯宮'),('宝瓶宮'),('双魚宮');

-- 性別
    DROP TABLE IF EXISTS seibetsu;
    CREATE TABLE IF NOT EXISTS seibetsu(
        id SERIAL,
        seibetsu_Name CHAR(2)
    );
    INSERT INTO seibetsu(seibetsu_Name) VALUES ('男性'), ('女性');


-- 季節
    DROP TABLE IF EXISTS kisetsu;
    CREATE TABLE IF NOT EXISTS kisetsu(
        id SERIAL,
        kisetsu_Name CHAR(1)
    );
    INSERT INTO kisetsu(kisetsu_Name) VALUES ('春'),('夏'),('秋'),('冬');


-- BMI
    DROP TABLE IF EXISTS BMI;
    CREATE TABLE IF NOT EXISTS BMI(
        id SERIAL,
        BMI CHAR(3)
    );

-- table `image_library`
--

DROP TABLE IF EXISTS `image_library`;
CREATE TABLE IF NOT EXISTS `image_library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quan_ao_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quan_ao_id` (`quan_ao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;    

-- 服情報
    DROP TABLE IF EXISTS `quan_ao`;
    CREATE TABLE IF NOT EXISTS quan_ao(
        id int(11) NOT NULL AUTO_INCREMENT,
        id_quanao TEXT,
        name TEXT,
        quantity INT DEFAULT 10,
        src_quanao TEXT NOT NULL,
        quanao_price BIGINT DEFAULT 100,
        content text,
        created_time int(11) NOT NULL,
        last_updated int(11) NOT NULL,
        PRIMARY KEY (id)
    )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- INSERT INTO quan_ao();

-- ALTER TABLE quan_ao ADD COLUMN quantity INT;
-- update quan_ao SET content
-- quan ao NAM id 59~91
    UPDATE `quan_ao` SET `content` = '無地のTシャツとロングジーンズを組み合わせたエレガントかつダイナミックなコーディネートは、端正なミニマリスト感を演出しながらも躍動感と着心地の良さを兼ね備えています' WHERE id = 1; 
    UPDATE `quan_ao` SET `content` = '滑らかな衿のTシャツとロングパンツを組み合わせたエレガントかつダイナミックなコーディネートは、大人のミニマルな雰囲気を醸し出しつつも、躍動感と着心地の良さを兼ね備えています。' WHERE id = 2;
    UPDATE `quan_ao` SET `content` = '無地のTシャツと破れたジーンズを組み合わせたエレガントでダイナミックなコーディネートは、大人のミニマルな雰囲気を醸し出しつつも、躍動感と着心地の良さを兼ね備えています。' WHERE id = 3;
    UPDATE `quan_ao` SET `content` = 'Tシャツとトラウザーズを合わせたエレガントかつダイナミックなセットは細身の方にも似合う横ストライプがバランスをとってくれます。' WHERE id = 4;
    UPDATE `quan_ao` SET `content` = 'オーバーサイズのTシャツとハーフパンツの組み合わせで、夏にふさわしい若々しくダイナミックな雰囲気を演出。 アクセントが際立つクロスボディバッグと合わせて。' WHERE id = 5;
    UPDATE `quan_ao` SET `content` = '夏に適した涼しげなシワ感のある生地を使用した小柄シャツに、ロングジーンズを合わせたベーシックな着こなしとアクティブな着心地。' WHERE id = 6;
    UPDATE `quan_ao` SET `content` = '無地のTシャツと破れたジーンズを組み合わせたエレガントでダイナミックなコーディネートは、大人のミニマルな雰囲気を醸し出しつつも、躍動感と着心地の良さを兼ね備えています。' WHERE id = 7;
    UPDATE `quan_ao` SET `content` = 'オーバーサイズのTシャツとショートパンツを合わせて、夏にぴったりの若々しくダイナミックな着こなしに。 細かな縦縞模様で太った体型の方にバランス感があり。' WHERE id = 8;
    UPDATE `quan_ao` SET `content` = 'オーバーサイズのTシャツとショートパンツを合わせて、夏にぴったりの若々しくダイナミックな着こなしに。 太めの体型の方にも似合うバランス感のある大きめの文字パターン' WHERE id = 9;
    UPDATE `quan_ao` SET `content` = 'チェックのシャツとV字ネック ニットトップスの外側にワイドレッグジーンズを組み合わせた. レイヤースタイルで細身の方にもバランス感を。 重ね着が多いのに幅が広いので着心地がいいです。' WHERE id = 10;
    UPDATE `quan_ao` SET `content` = 'Tシャツとジーンズジャケットは、個性を表現するのに最適な組み合わせです. あらゆる体型に合わせたセッティング。 アクセサリーは、セットのアクセントにできるメガネとネックレス。' WHERE id = 11;
    UPDATE `quan_ao` SET `content` = 'ポロシャツとバギーパンツを合わせて、寒い季節にぴったりの若々しくアクティブに。' WHERE id = 12;
    UPDATE `quan_ao` SET `content` = 'ニューエラ定番シルエットのトレーナーに、左胸MLBチームロゴ + 右胸ボックスロゴを配置したオンスポッツ別注商品です。左袖口にニューエラフラッグロゴの刺繍をセットしています。裏毛のスウェットを採用しました。軽いですが、冬には暖かいです。' WHERE id = 13;
    UPDATE `quan_ao` SET `content` = '軽く羽織れてしっかり暖かいダブルフェイス生地を採用したチェスターコート。ほどよくゆとりのあるサイジングで、肉厚なニットやジャケットの上からでもサラッと羽織れます。スカーフとビーニーを合わせてアクセントと暖かさをプラスします。' WHERE id = 14;
    UPDATE `quan_ao` SET `content` = 'スウェットシャツとワイドレッグのフェルトバギーパンツを組み合わせて快適な着心地を演出。 中には天候に合わせてTシャツやポロシャツなどを合わせても。 冬に厚着をしたくない方にぴったりの組み合わせです。' WHERE id = 15;
    UPDATE `quan_ao` SET `content` = '軽く羽織れてしっかり暖かいダブルフェイス生地を採用したチェスターコート。ほどよくゆとりのあるサイジングで、肉厚なニットやジャケットの上からでもサラッと羽織れます。丁寧でありながら温かみのあるセットです。' WHERE id = 16;
    UPDATE `quan_ao` SET `content` = 'バギーパンツと外の暑さをしのぐポロシャツ、ベースボールシャツの組み合わせで個性を表現できます。 これは、ダイナミックさと個性の両方の組み合わせです。' WHERE id = 17;
    UPDATE `quan_ao` SET `content` = '軽く羽織れてしっかり暖かいダブルフェイス生地を採用したチェスターコート。ほどよくゆとりのあるサイジングで、肉厚なニットやジャケットの上からでもサラッと羽織れます。丁寧でありながら温かみのあるセットです。' WHERE id = 18;
    UPDATE `quan_ao` SET `content` = 'オーバーサイズのポロシャツとジーンズを合わせて、冬にぴったりの若々しくダイナミックな着こなしに。 印象的なクロスボディバッグと合わせて。' WHERE id = 19;
    UPDATE `quan_ao` SET `content` = 'レイヤースタイルはレイヤーの組み合わせです。 タートルネックのセーターにジーンズのジャケット、毛皮のコートを合わせると、暖かさと若々しさが感じられます。' WHERE id = 20;
    UPDATE `quan_ao` SET `content` = 'ファーコートながら体にフィットするサイズ感でバランス感と暖かさを演出。 ジーンズと合わせて、シンプルだけど上品に。' WHERE id = 21;
    UPDATE `quan_ao` SET `content` = 'サーマル タートルネック T シャツとオーバーサイズのダーク レザー ジャケットの組み合わせは、冬にぴったりのチョイスです。 すべての体型の基本的な感覚を作成します。' WHERE id = 22;
    UPDATE `quan_ao` SET `content` = '毛皮の襟付きコートは、冬に最適です。 インナーにシャツやポロシャツ、バギーパンツと合わせやすく、個性を演出できます。' WHERE id = 23;
    UPDATE `quan_ao` SET `content` = 'サーマルポロシャツとバギーパンツを組み合わせたスーツ。 個性を際立たせる半袖ハットにライフジャケットがポイント。' WHERE id = 24;
    UPDATE `quan_ao` SET `content` = 'Tシャツとシャツは、丁寧さと若々しさを同時に感じる完璧な組み合わせです。 ジーンズやショートパンツと合わせることができます。' WHERE id = 25;

    -- ALTER TABLE quan_ao ADD COLUMN quanao_price BIGINT;

    --


-- -- お客さん提供情報
    DROP TABLE IF EXISTS kensa;
    CREATE TABLE IF NOT EXISTS kensa(
        id SERIAL,
        k_seibetsu TEXT,
        k_shinchou SMALLINT,
        k_taijuu SMALLINT,
        k_kisetsu TEXT,
        k_koudoutai TEXT,
        k_time DATETIME
    );

    -- insert into kensa( k_seibetsu, k_birthday,  k_shinchou, k_taijuu, k_time) 
    --     values ('A', '2021/11/04', 170, 60, NOW());



-- bmi_season
    DROP TABLE IF EXISTS bmi_season;
    CREATE TABLE IF NOT EXISTS bmi_season(
        bmi_season TEXT,
        KQ_id CHAR(3)
    );

    INSERT INTO bmi_season
    VALUES
        ('春やせる', '1G-'),
        ('春規範', '1C-'),
        ('春太い', '1M-'),

        ('夏やせる', '2G-'),
        ('夏規範', '2C-'),
        ('夏太い', '2M-'),

        ('秋やせる', '3G-'),
        ('秋規範', '3C-'),
        ('秋太い', '3M-'),

        ('冬やせる', '4G-'),
        ('冬規範', '4C-'),
        ('冬太い', '4M-');


-- ColorBoard
    DROP TABLE IF EXISTS colorboard;
    CREATE TABLE IF NOT EXISTS colorboard(
        colorKQ_id TEXT,
        color_id TEXT,
        color_id_2 TEXT
    );

-- INSERT DATA
-- cunghoangdao+thang+ngay, mau1, mau2
INSERT INTO colorboard
VALUES('10101', '49CFAC', '262F4E'),
     ('20101', '702FA3', '8297B2'),
     ('30101', '50BFEC', '4F7B26'),
     ('40101', 'FEC6B9', '88141F'),
     ('50101', '222F4F', 'D9D9D9'),
     ('60101', 'FADDDF', 'F33F6E'),
     ('70101', '16A4CC', '000000'),
     ('80101', 'FBB700', 'B7EBDE'),
     ('90101', '90111C', 'FFFF00'),
     ('100101', '732EA2', '06AEED'),
     ('110101', 'FFCD55', '7F7F7F'),
     ('120101', '7F7F7F', 'DBF4F9'),
     ('10102', '4CC2EA', '262F4C'),
     ('20102', '90101D', 'FFCE57'),
     ('30102', '1D9FD0', '507B21'),
     ('40102', '0D0D0B', '90D151'),
     ('50102', 'F72C03', 'F598A3'),
     ('60102', '7030A0', '012060'),
     ('70102', 'AA7902', 'FCB503'),
     ('80102', '9F1338', '242E51'),
     ('90102', 'C6E5A1', 'F72C04'),
     ('100102', '93DBF3', 'FDB600'),
     ('110102', '0F6C8B', 'FAA994'),
     ('120102', '262624', '77B935'),
     ('10103', '19A2CE', 'FFC100'),
     ('20103', '000000', 'F35264'),
     ('30103', 'C20000', 'FCB408'),
     ('40103', '2AA785', 'D9182D'),
     ('50103', '4DC1E8', '920F1F'),
     ('60103', '7F7F7F', '6F319C'),
     ('70103', 'C20000', '6F319C'),
     ('80103', '00B150', 'AB1B03'),
     ('90103', '0071C1', 'FDBE0E'),
     ('100103', '1C7058', 'F62D03'),
     ('110103', '000000', 'D21C2B'),
     ('120103', '1D6F58', 'FDB600'),
     ('10104', '79B833', '262F4C'),
     ('20104', 'FEA796', 'FAD24F'),
     ('30104', '02B0EF', '507B21'),
     ('40104', '93DBF4', '92D14E'),
     ('50104', 'FFCE55', 'F399A3'),
     ('60104', '4BCEAE', '012060'),
     ('70104', 'B3EDDE', 'FDB368'),
     ('80104', 'A51038', '1AA1D0'),
     ('90104', 'F8BBC2', 'F92B03'),
     ('100104', '74BA33', 'FBB507'),
     ('110104', '8396BA', 'FDA796'),
     ('120104', 'FEE394', '79B833'),
     ('10105', '28A885', 'ED3006'),
     ('20105', '1C7059', 'E85862'),
     ('30105', 'C10000', '49C4E6'),
     ('40105', '77B935', '8298B0'),
     ('50105', '435667', 'AB7900'),
     ('60105', 'AB7802', 'D11C2B'),
     ('70105', 'BB0300', '12A6CC'),
     ('80105', '00B150', '126C87'),
     ('90105', 'F32D06', 'FDBE0F'),
     ('100105', '00B34E', 'EB3204'),
     ('110105', 'FDB405', '1C7059'),
     ('120105', '000000', 'F92B03'),
     ('10106', '4CCEAC', '262F4C'),
     ('20106', '712F9F', '8297B0'),
     ('30106', '50BFEC', '507B21'),
     ('40106', 'FEC6B7', '950E1F'),
     ('50106', '242E51', 'D9D9D9'),
     ('60106', 'FADDDF', 'EC436E'),
     ('70106', '1D9FD0', '000000'),
     ('80106', 'FDB500', 'B7EBDE'),
     ('90106', '90101D', 'FFFF00'),
     ('100106', '7030A0', '05AFED'),
     ('110106', 'FFCE55', '7F7F7F'),
     ('120106', '7F7F7F', 'DCF3FB'),
     ('10107', '0170BF', 'A41E01'),
     ('20107', '1C7059', 'E93206'),
     ('30107', 'BD0200', '49C3E8'),
     ('40107', '000000', '6F319E'),
     ('50107', 'A1410F', 'AB7803'),
     ('60107', '4BCFAA', 'D41B2D'),
     ('70107', 'C10000', '19A2D0'),
     ('80107', 'D8182F', 'EB3206'),
     ('90107', '527A21', 'FCBF0E'),
     ('10107', '19A2D0', '70319A'),
     ('110107', 'F62C04', '8C121F'),
     ('120107', '000000', '0073C4'),
     ('10108', '767070', '8397B0'),
     ('20108', 'A41E01', 'DBF4FB'),
     ('30108', '0D0D0B', '45C6E5'),
     ('40108', 'FDFF01', 'EB426D'),
     ('50108', 'BFBFBD', 'FFB305'),
     ('60108', '116C8B', '01215E'),
     ('70108', 'FDC100', 'E9426D'),
     ('80108', 'D9172F', 'FCC6BA'),
     ('90108', '252E4F', 'D5DCE4'),
     ('100108', '28A885', '0073CB'),
     ('110108', 'FEE396', '404040'),
     ('120108', '00215E', '90101F'),
     ('10109', '90101D', '23314C'),
     ('20109', '77B933', 'FAD24E'),
     ('30109', '03AFEF', '70319C'),
     ('40109', '0D0D0B', '90D151'),
     ('50109', '90E3CF', 'F498A3'),
     ('60109', 'FDE494', '012060'),
     ('70109', '74BB31', 'FCB40A'),
     ('80109', 'FDA798', '97D9F1'),
     ('90109', 'FCB600', 'F22E06'),
     ('100109', '2EA587', 'FFAF00'),
     ('110109', '8298B0', '1F6E59'),
     ('120109', '0071C1', '77B935'),
     ('10110', 'FDB500', 'A81C01'),
     ('20110', '9F420E', 'ED3104'),
     ('30110', '25304E', 'AA7A00'),
     ('40110', 'FCB600', '9D4311'),
     ('50110', '056FB9', '9F420F'),
     ('60110', '8298AD', 'E30D7D'),
     ('70110', 'F32E01', '000000'),
     ('80110', '2AA785', 'E20E7C'),
     ('90110', '02B0ED', '930E1F'),
     ('100110', '0071C1', '79B833'),
     ('110110', 'FA2A06', '4F7B26'),
     ('120110', 'EA0A7A', '46D1AA'),
     ('10111', '1CA0D1', '25304C'),
     ('20111', 'A22000', 'FDD14E'),
     ('30111', '2BA785', '6F31A0'),
     ('40111', 'AB7802', '92D14E'),
     ('50111', 'FFCF51', 'F498A3'),
     ('60111', '7030A0', '01215E'),
     ('70111', '00B1EF', 'FCB40A'),
     ('80111', 'FBA896', 'C5E5A4'),
     ('90111', '77B935', 'EC3104'),
     ('100111', 'F62D03', 'FDB308'),
     ('110111', '002260', '1C7059'),
     ('120111', '0071BF', 'FCD14F'),
     ('10112', 'E50C7F', 'A51E01'),
     ('20112', '19A2D0', 'AA7902'),
     ('30112', 'F62C04', '01215E'),
     ('40112', '20DC30', '9E420F'),
     ('50112', '6F30A5', 'FDB500'),
     ('60112', 'FDB403', 'E20E7C'),
     ('70112', 'F42D04', '42D3AC'),
     ('80112', '116C89', 'E50D7C'),
     ('90112', '930F1D', '8397B0'),
     ('100112', '000000', '79B833'),
     ('110112', '000000', 'DE107C'),
     ('120112', '00B34E', '70319C'),
     ('10113', '40403E', '262F4C'),
     ('20113', 'D4DDE4', '79B833'),
     ('30113', 'A22000', 'BFBFBF'),
     ('40113', 'FDE398', 'FBDDDF'),
     ('50113', '262624', '18A3CC'),
     ('60113', '7F7F7D', 'FFFE04'),
     ('70113', '2AA785', '507A24'),
     ('80113', '91DBF6', '950E1F'),
     ('90113', '00215E', 'E6E6E6'),
     ('100113', 'E5446D', '12A6CC'),
     ('110113', 'F598A3', 'B60400'),
     ('120113', 'BFBFBD', '116C89'),
     ('10114', '76B935', 'A02101'),
     ('20114', '000000', 'AA7902'),
     ('30114', 'F92B06', '1C7059'),
     ('40114', 'A85698', '9D4213'),
     ('50114', '2BA785', 'FBB505'),
     ('60114', 'FDB403', 'AB1B03'),
     ('70114', '126B89', 'FB0200'),
     ('80114', '1C7059', 'DE107C'),
     ('90114', '9E2200', '222B34'),
     ('100114', 'A75794', '77B935'),
     ('110114', '116C89', 'DE107C'),
     ('120114', '435569', 'DE107C'),
     ('10115', 'D4DCE4', '94DAF4'),
     ('20115', 'FDFF01', 'F42D03'),
     ('30115', '595957', '970C1F'),
     ('40115', 'A6A6A4', 'FDD053'),
     ('50115', '1D9FD0', '012060'),
     ('60115', '0D0D0B', 'C5E5A4'),
     ('70115', 'ADB9C9', 'D41B2B'),
     ('80115', 'C6E4A4', 'FFEBBC'),
     ('90115', '40403E', '18A3CC'),
     ('100115', 'FCB700', 'A6A6A6'),
     ('110115', '002260', '0D0D0D'),
     ('120115', '7F7F7D', 'C50002'),
     ('10116', '90E3CF', 'FFE199'),
     ('20116', '4F7B24', 'FFCE51'),
     ('30116', '4DC1E8', 'FFFF01'),
     ('40116', 'FA2A04', '92D14E'),
     ('50116', '00B24E', 'F399A3'),
     ('60116', '70319C', 'FFE198'),
     ('70116', 'F499A0', 'FBB800'),
     ('80116', 'FEA698', '507A24'),
     ('90116', '222A35', 'F22E06'),
     ('100116', 'DDF3F0', 'F9B800'),
     ('110116', 'E6E6E4', '1D6F59'),
     ('120116', '0071BF', '01215C'),
     ('10117', '02B0EF', 'A91B03'),
     ('20117', 'F92B06', 'A57D00'),
     ('30117', 'EA0A7A', '1B7059'),
     ('40117', '50C0E5', '9E430E'),
     ('50117', '2DA687', 'FBB505'),
     ('60117', '000000', 'A71D01'),
     ('70117', 'FFC100', 'FA0200'),
     ('80117', 'FFBF00', '000000'),
     ('90117', 'A41E01', '0072C4'),
     ('100117', '0F6C8B', '77B836'),
     ('110117', '000000', 'DC117C'),
     ('120117', 'AB7802', '70319C'),
     ('10118', '1C7059', 'FFE199'),
     ('20118', '527A21', '96DAF1'),
     ('30118', 'FBA898', 'FFFF01'),
     ('40118', '0171BD', '90D151'),
     ('50118', '6F319C', 'F399A3'),
     ('60118', '28A885', 'FFE199'),
     ('70118', '0072C2', 'FBB800'),
     ('80118', 'FDFF00', '507A24'),
     ('90118', '8397B2', 'F22E06'),
     ('100118', 'F498A3', 'FBB800'),
     ('110118', 'FDE398', '1D6F59'),
     ('120118', '507A24', '01215E'),
     ('10119', '03AFED', 'AB7900'),
     ('20119', 'F62B04', '222A35'),
     ('30119', 'FFBF03', '1F6E59'),
     ('40119', 'FFC200', '9E430E'),
     ('50119', '2EA587', '000000'),
     ('60119', 'A77B00', 'A91B03'),
     ('70119', '146B87', 'FB0200'),
     ('80119', '4E7D21', 'D11C2D'),
     ('90119', 'A51E01', 'FCC200'),
     ('100119', 'F03100', '79B833'),
     ('110119', 'EF3004', '146B86'),
     ('120119', 'AA7A00', '6F319E'),
     ('10120', '45D1AC', '262F4C'),
     ('20120', '722FA0', '8298B0'),
     ('30120', '4DC0EC', '507B1F'),
     ('40120', 'FEC6B7', '950E1F'),
     ('50120', '242F4F', 'D9D9D9'),
     ('60120', 'FBDDDF', 'F53E6E'),
     ('70120', '1D9FD0', '000000'),
     ('80120', 'FDB500', 'B7EBDE'),
     ('90120', '92101C', 'FFFF00'),
     ('100120', '722FA0', '06AEEC'),
     ('110120', 'FFCE55', '7F7F7F'),
     ('120120', '7F7F7F', 'DBF4FB'),
     ('10121', 'F62D03', 'A87C00'),
     ('20121', 'FA2A06', 'DE107C'),
     ('30121', 'E20D81', '206D59'),
     ('40121', 'FFC000', '44546B'),
     ('50121', '7AB736', 'DC172B'),
     ('60121', '00B1F1', 'A71D00'),
     ('70121', '1F8B11', 'F6554D'),
     ('80121', '23314C', 'DC172B'),
     ('90121', '126B8B', 'FFBE08'),
     ('100121', '000000', '79B833'),
     ('110121', 'F92B06', '1E8C11'),
     ('120121', 'FE9805', '70319A'),
     ('10122', '767070', '8397AF'),
     ('20122', 'A21F01', 'DCF3FB'),
     ('30122', '0D0D0B', '46C5E5'),
     ('40122', 'FBFF06', 'E9426D'),
     ('60122', 'BFBFBD', 'FDB308'),
     ('70122', 'FDC100', 'EB426D'),
     ('80122', 'E01331', 'FCC7B7'),
     ('90122', '22304B', 'D5DCE2'),
     ('100122', '28A885', '0072C2'),
     ('110122', 'FEE298', '404040'),
     ('120122', '02205E', '970D1D'),
     ('10123', 'C6E4A2', 'FFE197'),
     ('20123', '527923', 'FAA895'),
     ('30123', '97DAED', 'FFFE01'),
     ('40123', '70309E', '8FD24E'),
     ('50123', 'FDB403', 'F399A3'),
     ('60123', '2AA785', '0071BF'),
     ('70123', '000000', 'FDB308'),
     ('80123', 'FBA896', '507B21'),
     ('90123', '002160', 'EC3104'),
     ('100123', 'F499A2', 'AB7900'),
     ('110123', 'FFE099', '1D6F59'),
     ('120123', '537922', '46D0AC'),
     ('10124', '46D0AE', 'A77C00'),
     ('20124', '445569', 'DE107C'),
     ('30124', '9D2100', '1C7059'),
     ('40124', 'FDC200', '79B835'),
     ('50124', '010000', 'D11C2B'),
     ('60124', '722FA2', 'A81C01'),
     ('70124', '218A13', '2AA787'),
     ('80124', '25304E', 'F22E04'),
     ('90124', '0F6C8B', 'EB3206'),
     ('100124', 'FDC101', '77B836'),
     ('110124', '0D0D0D', '1F8B11'),
     ('120124', '9E420F', '6F31A0'),
     ('10125', 'AC7802', 'FFE296'),
     ('20125', 'D8182D', 'FBA898'),
     ('30125', 'FCB600', 'FFFF00'),
     ('40125', '537922', '92D14E'),
     ('50125', 'D9182D', 'F498A3'),
     ('60125', '94DBF1', '0073C8'),
     ('70125', 'FDE396', 'FCB40A'),
     ('80125', 'FBA898', 'EC436E'),
     ('90125', 'FBA896', 'F32D06'),
     ('100125', 'F498A3', '90E3CF'),
     ('110125', 'D9EEC3', '1D6F59'),
     ('120125', '23314E', '3FD4AA'),
     ('10126', '4FCCAE', 'FD6E50'),
     ('20126', 'FE9805', 'DE107C'),
     ('30126', 'A41E01', 'FE9900'),
     ('40126', '920F1D', '79B835'),
     ('50126', '1D9FD3', 'A75796'),
     ('60126', '9F420E', '116C89'),
     ('70126', '1E8C0F', '222B34'),
     ('80126', 'E20E7F', 'F32E04'),
     ('90126', '1C7059', 'A87C00'),
     ('100126', 'AB7803', '77B836'),
     ('110126', 'FCB600', '218A13'),
     ('120126', '9F420F', 'FCB600'),
     ('10127', '40403E', '252F50'),
     ('20127', 'D5DCE4', '77B737'),
     ('30127', 'A41E03', 'BFBFBF'),
     ('40127', 'FEE298', 'FBDDDF'),
     ('50127', '262624', '13A5CC'),
     ('60127', '7F7F7D', 'FFFE06'),
     ('70127', '28A885', '507B22'),
     ('80127', '96DAF1', '970C1F'),
     ('90127', '01215E', 'E6E6E6'),
     ('100127', 'EB426D', '1D9FD0'),
     ('110127', 'F598A2', 'BE0000'),
     ('120127', 'BFBFBD', '126C86'),
     ('10128', 'F62C04', '0074C8'),
     ('20128', 'FD9B00', 'DF0F7D'),
     ('30128', '4E7D21', '00225C'),
     ('40128', '920F1D', 'ED3006'),
     ('50128', 'FB5152', 'A65798'),
     ('60128', '9F420E', 'D7BD12'),
     ('70128', 'D51A2F', '4F490B'),
     ('80128', '00B24E', 'CAD028'),
     ('90128', '1F6E59', 'C00000'),
     ('100128', '181715', '79B931'),
     ('110128', 'FFB403', '8B2E0F'),
     ('120128', '126B89', 'FCB600'),
     ('10129', 'D5DCE6', '94DAF3'),
     ('20129', 'FEFF00', 'EC3203'),
     ('30129', '595957', '970C1F'),
     ('40129', 'A6A6A4', 'FDD053'),
     ('50129', '18A2D1', '01215E'),
     ('60129', '0D0D0B', 'C6E4A4'),
     ('70129', 'ACB9CA', 'E2142B'),
     ('80129', 'C6E5A1', 'FFEBBC'),
     ('90129', '40403E', '11A7CC'),
     ('100129', 'FCB600', 'A6A6A6'),
     ('110129', '022060', '0D0D0D'),
     ('120129', '7F7F7D', 'B90400'),
     ('10130', 'A87B00', 'FF6B55'),
     ('20130', 'FFCE57', 'FAA994'),
     ('30130', '3FD4AC', 'FFFE04'),
     ('40130', 'FAAA93', '92D051'),
     ('50130', '01215C', 'F399A3'),
     ('60130', 'A21F01', '0072C6'),
     ('70130', 'B3EDDE', 'F9B607'),
     ('80130', '222F4F', 'EE416E'),
     ('90130', 'D9EFC1', 'F42C08'),
     ('100130', 'F399A2', '126C86'),
     ('110130', 'D9EEC3', '00B4F4'),
     ('120130', '253050', 'FBA994'),
     ('10131', '722FA0', '0074C4'),
     ('20131', 'AC7900', 'DE107C'),
     ('30131', '527A24', '7230CE'),
     ('40131', '920F1D', '000000'),
     ('50131', '46D0AC', 'A85696'),
     ('60131', '9E420F', '126C86'),
     ('70131', 'D6192F', '4F230A'),
     ('80131', '00B34E', 'EF9509'),
     ('90131', 'EF940F', 'B90300'),
     ('100131', 'FF649A', '79B931'),
     ('110131', '37CA31', '8C2D0F'),
     ('120131', '0F6C8B', 'FF7B7F');



-- userTable 
DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nickname` VARCHAR(32) NOT NULL,
  `email` VARCHAR(264) NOT NULL,
  `verified` INT(11) NOT NULL COMMENT '0=no, 1=yes',
  `verification_code` VARCHAR(264) NOT NULL,
  `created` datetime NOT NULL,
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;


INSERT INTO `users`(`nickname`,`email`, `verified`, `verification_code`, `created`)
VALUES( 'THANG', 'dvthang2906@gmail.com', '0', 'beee6a2335863bb3ac7caaa5cbf47fd7','2023-01-03 20:09:12');

-- thong tin 1 đơn hàng của khách
-- order TABLE
DROP TABLE IF EXISTS orderr;
CREATE TABLE IF NOT EXISTS orderr (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `note` text NOT NULL,
  `total` int(11) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `orderr` (`name`, `phone`, `address`, `note`, `total`, `created_time`, `last_updated`) VALUES
( 'HAU', '09041777923', 'Ha Noi', 'Ghi chu', 10000, 1587872426, 1587872426);


-- thông tin cho tiết từng sản phẩm khách đã mua trong 1 đơn hàng
-- Table structure for table `order_detail`
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `id_quanao` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `id_quanao` (`id_quanao`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------



--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_library`
--
ALTER TABLE `image_library`
  ADD CONSTRAINT `image_library_ibfk_1` FOREIGN KEY (`quan_ao_id`) REFERENCES `quan_ao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
-- --
-- ALTER TABLE `order_detail`
--   ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
--   ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`id_quanao`) REFERENCES `quan_ao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;




