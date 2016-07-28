<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BoardTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * 掲示板トップページの表示内容のテスト
     *
     * @return void
     */
    public function testIndex()
    {
        $first = factory(App\Board::class)->create();
        $first->title = 'タイトルその1';
        $first->save();
        $this->visit('/boards')
        ->see('掲示板のテスト')
        ->see('タイトルその1')
        ->dontSee('タイトルその2');
    }

    /**
     * 掲示板の内容追加時の挙動のテスト
     *
     * @return void
     */
    public function testAddBoard()
    {
        // 投稿前なので、データ無し
        $this->visit('/boards')->dontSee('タイトルその2')->dontSee('本文その2本文その2');

        // テストデータの持ち越しはない
        $this->visit('/boards')->dontSee('タイトルその1');

        //新規投稿画面に遷移できる
        $this->visit('/boards')->click('新規投稿')->seePageIs('/boards/new');

        // 投稿後、掲示板トップに戻る
        $this->visit('/boards/new')
        ->type('タイトルその2', 'title')
        ->type('本文その2本文その2', 'content')
        ->press('送信')->seePageIs('/boards');

        // 投稿したデータが存在している
        $this->visit('/boards')->see('タイトルその2')->see('本文その2本文その2');
    }

    /**
     * 掲示板追加時にバリデーションエラーが発生した時のテスト
     *
     * @return void
     */
    public function testAddBoardVaridation()
    {
        $this->visit('/boards')->dontSee('タイトルその3');

        $this->visit('/boards/new')->type('あいうえおあいうえおあ', 'title')
        ->type('本文テスト3', 'content')->press('送信')->seePageIs('/boards/new')
        ->see('入力値に以下の不正が発見されました')
        ->see('titleは10文字以下にしてください。');
    }

    
}
