-- MySQLにrootで初回パスワードなしログイン
mysql -u root


-- MySQL終了
exit


-- パスワードの設定
set password for root@localhost=password('パスワード');


-- rootにパスワード設定した状態でログイン
mysql -u root -p


-- データベースの作成(rootでないとデータベース作成できない)
create database blog_app;


-- データベースごとの作業ユーザー(ユーザー名→「dbuser」にする場合)とパスワード設定
grant all on blog_app.* to dbuser@localhost identified by 'パスワード';


-- 作業ユーザーでパスワードありログイン
mysql -u dbuser -p


-- 作業ユーザーでパスワードありログイン、使用するデータベース名もまとめて宣言する場合
mysql -u dbuser -p blog_app


-- データベース一覧を表示
show databases;


-- データベース削除
drop database blog_app;


-- 使用するデータベースを切り換える
use blog_app;


-- テーブル一覧を表示
show tables;


-- テーブル削除
drop table users;


-- テーブル作成
CREATE TABLE users (
 id int not null auto_increment primary key,
 name varchar(255),
 email varchar(255) unique,
 password char(32),
 score double,
 gender enum('male','female') default 'male',
 team enum('blue','red','yellow'),
 memo text,
 created datetime,
 key score (score)
);


-- テーブル作成
CREATE TABLE posts (
 id int not null auto_increment primary key,
 user_id int not null,
 title varchar(255),
 body text,
 created datetime
);


-- テーブルの内容を表示
desc users;


-- レコードの挿入
INSERT INTO users (name,email,password,score,gender,team,memo,created) VALUES
('大阪 太郎','osaka@vo.co.jp','1111',85,'male','blue','あいうえお','2016-09-01 11:00:00'),
('東京 一郎','tokyo@vo.co.jp','2222',76,'male','yellow','かきくけこ','2016-09-05 12:00:00'),
('福岡 愛','fukuoka@vo.com','3333',70,'female','red','さしすせそ','2016-09-01 16:00:00'),
('香川 真希','kagawa@vo.co.jp','4444',78,'female','yellow','たちつてと','2016-09-03 09:48:00'),
('宮崎 恋','miyazaki@vo.com','5555',64,'male','red','なにぬねの','2016-09-02 21:00:00'),
('山口 佳奈','yamaguchi@vo.co.jp','6666',85,'female','blue','はひふへほ','2016-09-03 10:00:00');


-- レコードの挿入
INSERT INTO posts (user_id,title,body,created) VALUES
('1','タイトル1 by 大阪 太郎','本文1','2016-10-01 11:00:00'),
('1','タイトル2 by 大阪 太郎','本文2','2016-10-04 18:00:00'),
('2','タイトル3 by 東京 一郎','本文3','2016-10-01 13:00:00'),
('3','タイトル4 by 福岡 愛','本文4','2016-10-02 11:00:00'),
('3','タイトル5 by 福岡 愛','本文5','2016-10-05 12:00:00');


-- テーブル内のすべてのレコードを抽出
SELECT * FROM users;


-- テーブル内のすべてのレコードを抽出(縦に並べる)
SELECT * FROM users \G;


-- テーブル内の名前とメールアドレスのみ抽出
SELECT name, email FROM users;


-- スコアが85のレコードを抽出
SELECT * FROM users WHERE score = 85;


-- スコアが75以上のレコードを抽出
SELECT * FROM users WHERE score >= 75;


-- スコアが85ではないレコードを抽出
SELECT * FROM users WHERE score != 85;


-- チームがredではないレコードを抽出
SELECT * FROM users WHERE team != 'red';


-- 登録日が9/3以降のレコードを抽出
SELECT * FROM users WHERE created > '2016-09-03 00:00:00';


-- メールアドレスがvo.comのレコードを抽出 % → 任意の文字列
SELECT * FROM users WHERE email LIKE '%@vo.com';


-- メールアドレスがvo.comのレコードを抽出 _ → 任意の1文字
SELECT * FROM users WHERE email LIKE '%@vo.___';


-- スコアが70〜80のレコードを抽出
SELECT * FROM users WHERE score BETWEEN 70 and 80;


-- チームがred、yellowのレコードを抽出
SELECT * FROM users WHERE team in ('red','yellow');


-- スコアが70以上かつチームがredのレコードを抽出
SELECT * FROM users WHERE score >= 70 AND team = 'red';


-- スコアが80以上またはチームがyellowのレコードを抽出
SELECT * FROM users WHERE score >= 80 OR team = 'yellow';


-- スコア順に並べる(昇順)
SELECT * FROM users ORDER BY score;


-- スコア順に並べる(降順)
SELECT * FROM users ORDER BY score DESC;


-- ３件のみ抽出
SELECT * FROM users LIMIT 3;


-- 2番目から2件のみ抽出(最初は0番目から)
SELECT * FROM users LIMIT 2, 2;


-- スコア上位3件を抽出
SELECT * FROM users ORDER BY score DESC LIMIT 3;


-- レコードの件数集計
SELECT COUNT(*) FROM users;


-- ユニークな値を集計
SELECT DISTINCT team FROM users;


-- 最大値を抽出
SELECT MAX(score) FROM users;


-- 最小値を抽出
SELECT MIN(score) FROM users;


-- 平均値を抽出
SELECT AVG(score) FROM users;


-- 合計を抽出
SELECT SUM(score) FROM users;


-- チーム毎の平均値を抽出
SELECT team,AVG(score) FROM users GROUP BY team;


-- 乱数
SELECT RAND();


-- ランダムにレコードを１件抽出する
SELECT * FROM users ORDER BY RAND() LIMIT 1;


-- メールアドレスの長さを抽出
SELECT email, LENGTH(email) FROM users;


-- 文字列を連結
SELECT CONCAT(name,'(',team,')') FROM users;


-- 関数名を任意の名前に変更
SELECT CONCAT(name,'(',team,')') AS '氏名(所属チーム)' FROM users;


-- 文字列の一部を取得する
-- 例 → チーム名の頭文字だけ(１文字目から１文字)
SELECT name,SUBSTRING(team,1,1) FROM users;


-- 現在の日付時刻
SELECT NOW();


-- 日付時刻から月だけを表示
SELECT name, MONTH(created) FROM users;


-- 日付の差分
SELECT name, DATEDIFF(NOW(), created) FROM users;


-- id7のメールアドレスを更新
UPDATE users SET email = 'aichi_nagoya@vo.co.jp' WHERE id = 7;


-- スコアが60以下のレコードを削除
DELETE FROM users WHERE score <= 60;


-- フィールドを末尾に追加
ALTER TABLE users ADD age varchar(3);


-- フィールドを指定のものの１つ後ろに追加
ALTER TABLE users ADD age varchar(3) AFTER name;


-- フィールドを変更
ALTER TABLE users CHANGE age birthplace varchar(20);


-- フィールドを削除
ALTER TABLE users DROP birthplace;


-- フィールドにインデックスを追加
ALTER TABLE users ADD INDEX mailaddress(email);


-- フィールドのインデックスを削除
ALTER TABLE users DROP INDEX mailaddress;


-- テーブル名変更
ALTER TABLE users RENAME blog_users;


-- 複数のテーブルから抽出
SELECT users.name, posts.title FROM users, posts WHERE users.id = posts.user_id;


-- 複数のテーブルから新着順で抽出
SELECT users.name, posts.title, posts.created FROM users, posts WHERE users.id = posts.user_id ORDER BY posts.created DESC;


-- 外部ファイル実行
mysql -u dbuser -p blog_app < external.sql


-- バックアップ作成
mysqldump -u dbuser -p blog_app > blog_app_back_up.sql


-- 既に同名のテーブルが存在する場合。テーブルを上書きする書き方
DROP TABLE IF EXISTS greeting;

CREATE TABLE greeting (
 id int not null auto_increment primary key,
 country varchar(255),
 word text,
 created datetime
);

INSERT INTO greeting (country,word,created) VALUES
('日本','こんにちは','2016-08-01 11:00:00'),
('日本','こんばんは','2016-08-03 16:00:00'),
('日本','おはようございます','2016-08-01 09:00:00'),
('アメリカ','グッドモーニング','2016-08-03 11:00:00'),
('フランス','ボンジュール','2016-08-04 18:00:00'),
('イタリア','ボンジョルノ','2016-08-02 21:00:00');









