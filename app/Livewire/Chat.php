<?php

namespace App\Livewire;

use App\Events\MessageSentEvent;
use App\Events\UnreadMessage;
use App\Events\UserTyping;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Chat extends Component
{

    use WithFileUploads;

    public $user;
    public $message; // input field er text ei attribute e bind hobe
    public $senderId;
    public $receiverId;
    public $messages;
    public $file;
    
    public function mount($userId)
    {

        $this->dispatch('messages-updated'); #r jeno scroll korte nah lage niche

        $this->user = $this->getUser($userId);

        $this->senderId = Auth::user()->id;
        $this->receiverId = $userId;

        $this->messages = $this->getMessages();

        $this->readAllMessages();


    }

    public function render()
    {
        $this->readAllMessages();

        return view('livewire.chat');
    }
    

    public function getMessages()
    {
        return Message::with('sender:id,name','receiver:id,name')
        ->where(function($query){
        $query->where('sender_id', $this->senderId)
        ->where('receiver_id',$this->receiverId);
    })
    ->orwhere(function($query){
        $query->orWhere('sender_id',$this->receiverId)
        ->Where('receiver_id',$this->senderId);
    })
        ->get();
    }


    public function UserTyping()  {
        broadcast(new UserTyping($this->senderId,$this->receiverId))->toOthers();
    }

    public function readAllMessages()
    {
        Message::where('sender_id',$this->receiverId)
        ->where('receiver_id',$this->senderId)
        ->where('is_read',false)
        ->update(['is_read'=>true]);
    }


    /**
     * Function: getUser
     * @param userId
     * @return App\Models\User
     */

    public function getUser($userId)
    {
        return User::find($userId);
    }

    public function sendMessage() // eita message save kore 
    {

        $sentMessage = $this-> saveMessage();
        
        $this->messages[] = $sentMessage; #assigning latest message

        broadcast(new MessageSentEvent($sentMessage)); #broadcast message

        $unreadMessageCount = $this->getUnreadMessagesCount();

        broadcast(new UnreadMessage($this->senderId,$this->receiverId,$unreadMessageCount))->toOthers();

        $this->message = null;

        $this->file = null;

        $this->dispatch('messages-updated');
        

    }

    public function getUnreadMessagesCount()
    {
        return Message::where('receiver_id', $this->receiverId)
            ->where('is_read', false)
            ->count();
    }

    #[On('echo-private:chat-channel.{senderId},MessageSentEvent')]
    public function listenMessgae($event)
    {
        #message converted to eloquent
        $newMessage = Message::find($event['message']['id'])->load('sender:id,name','receiver:id,name');
        $this->messages[] = $newMessage;
    }



    /**
     * Function: sendMessage
     * @param NA
     * @return
     */

    public function saveMessage()
    {

        if ($this->file) {
            // Proceed with the file handling if it's not null
            $fileName = $this->file->hashName();
            $fileOriginalName = $this->file->getClientOriginalName();
            $folderPath = $this->file->store('chat_files', 'public');
            $fileType = $this->file->getMimeType();
        } else {
            // If no file is uploaded, handle accordingly
            $fileName = null;
            $fileOriginalName = null;
            $folderPath = null;
            $fileType = null;
        }



        return Message::create([
            'sender_id' => $this->senderId,
            'receiver_id' => $this-> receiverId,
            'message' => $this->message,
            'file_name' => $fileName,
            'file_original_name' => $fileOriginalName,
            'folder_path' => $folderPath,
            'file_type' =>$fileType,
            'is_read' => false
        ]);
    }

}
