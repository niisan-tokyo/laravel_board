# BoardTest for using Laravel

[![Build Status](https://travis-ci.org/niisan-tokyo/laravel_board.svg?branch=master)](https://travis-ci.org/niisan-tokyo/laravel_board)

Laravelを使用して掲示板を作る習作アプリ。
以下を重点的に試行する

+ Laravelのルーティングの仕組み
+ テスト
+ CI連携
+ デプロイ
+ マイグレーション

## LaraDock

本アプリケーションのために、LaraDockを使用している
http://laradock.github.io/laradock/

LaraDockを使用することにより、動作に必要な最低限の機能を、能動的に認識可能である
Vagrantのhomesteadイメージの仕様に比べて若干手間が増える部分もあるが、より実働環境に近い動きを再現できるため、
LaraDockを採用する

## テスト

テストされていないアプリケーションを商用にのせることは、危険。
Laravelではルーティングをシミュレートするテスト用のAPIを搭載しているため、
リソースごとのテストが可能であるため、URIごとのテストを実施する。
細かいバリデーションや例外処理など、URIへのアクションのテストだけではまかないきれない場合は、
通常のユニットテストを使用することで、ロジックのテストを保管する。

また、テストに使用するDBは専用のものを用意しよう
