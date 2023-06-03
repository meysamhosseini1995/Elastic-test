<?php

namespace Tests\Feature\Notifications;

use App\Models\User;
use App\Notifications\TaskFoundNotices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class TaskFoundNoticesTest extends TestCase
{
    public User $user;

    public function testMailNotification()
    {
        // Arrange
        Notification::fake();
        $this->user = User::factory()->create();
        $email_subject = "Task Found";

        // Act
        $this->user->notify(new TaskFoundNotices($email_subject));

        // Assert
        Notification::assertSentTo($this->user, TaskFoundNotices::class, function ($notification, $channels) use($email_subject){
            $this->assertContains('mail', $channels);

            $mailNotification = (object)$notification->toMail($this->user);
            $this->assertEquals($email_subject, $mailNotification->subject,);

            $this->assertEquals('The introduction to the notification.', $mailNotification->introLines[0]);
            $this->assertEquals('Thank you for using our application!', $mailNotification->outroLines[0]);
            $this->assertEquals('Notification Action', $mailNotification->actionText);
            $this->assertEquals($mailNotification->actionUrl, url('/'));

            return true;
        });
    }
}
