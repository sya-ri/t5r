<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Auth;
use Livewire\Component;

class CreateMessageForm extends Component
{
    /**
     * メッセージの最大長
     *
     * - [処理の流れ] フロントエンドから送信されたメッセージの先頭・末尾の空白を削除(trim)してデータベースに格納する
     * - [フロントエンド] 処理の簡略化のために先頭・末尾の空白を考慮して文字列の長さを求める
     * - [バックエンド] 先頭・末尾の空白を削除してから文字列の長さを求める
     */
    const MaxLength = 255;

    public $content = '';

    public function render()
    {
        return view('livewire.create-message-form');
    }

    public function onSubmit()
    {
        $this->content = trim($this->content);
        if ($this->content) {
            if (strlen($this->content) <= self::MaxLength) {
                Message::create(['user_id' => Auth::user()->id, 'content' => $this->content]);
                redirect(request()->header('Referer')); // reload page
            } else {
                $this->addError('content', '255文字以下のメッセージしか送信できません');
            }
        }
    }
}
