<!-- https://codepen.io/sajadhsm/pen/odaBdd -->
<style>
:root {
  --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  --msger-bg: #fff;
  --border: 2px solid #ddd;
  --left-msg-bg: #ececec;
  --right-msg-bg: #579ffb;
}

html {
  box-sizing: border-box;
}

*,
*:before,
*:after {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}

body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-image: var(--body-bg);
  font-family: Helvetica, sans-serif;
}

.msger {
  margin-top: 0.5em;
  position: fixed;
  display: flex;
  flex-flow: column wrap;
  justify-content: space-between;
  width: 100%;
  max-width: calc(100vh - 10px);;
  height: calc(100% - 50px);
  border: var(--border);
  border-radius: 5px;
  background: var(--msger-bg);
  box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
}

.msger-header {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  border-bottom: var(--border);
  background: #eee;
  color: #666;
}

.msger-chat {
  flex: 1;
  overflow-y: auto;
  padding: 10px;
}
.msger-chat::-webkit-scrollbar {
  width: 6px;
}
.msger-chat::-webkit-scrollbar-track {
  background: #ddd;
}
.msger-chat::-webkit-scrollbar-thumb {
  background: #bdbdbd;
}
.msg {
  display: flex;
  align-items: flex-end;
  margin-bottom: 10px;
}
.msg:last-of-type {
  margin: 0;
}
.msg-img {
  width: 50px;
  height: 50px;
  margin-right: 10px;
  background: #ddd;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  border-radius: 50%;
}
.msg-bubble {
  max-width: 450px;
  padding: 15px;
  border-radius: 15px;
  background: var(--left-msg-bg);
}
.msg-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}
.msg-info-name {
  margin-right: 10px;
  font-weight: bold;
}
.msg-info-time {
  font-size: 0.85em;
}

.left-msg .msg-bubble {
  border-bottom-left-radius: 0;
}

.right-msg {
  flex-direction: row-reverse;
}
.right-msg .msg-bubble {
  background: var(--right-msg-bg);
  color: #fff;
  border-bottom-right-radius: 0;
}
.right-msg .msg-img {
  margin: 0 0 0 10px;
}

.msger-inputarea {
  display: flex;
  padding: 10px;
  border-top: var(--border);
  background: #eee;
}
.msger-inputarea * {
  padding: 10px;
  border: none;
  border-radius: 3px;
  font-size: 1em;
}
.msger-input {
  flex: 1;
  background: #ddd;
}
.msger-send-btn {
  margin-left: 10px;
  background: rgb(0, 196, 65);
  color: #fff;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.23s;
}
.msger-send-btn:hover {
  background: rgb(0, 180, 50);
}

.msger-chat {
  background-color: #fcfcfe;
  background-image: none;
}
</style>

<section class="msger">
  <header class="msger-header">
    <div class="msger-header-title">
      <i class="fas fa-comment-alt"></i> Cardio-Message
    </div>
  </header>

  <main class="msger-chat">

    <?php
$idClub = getIdClub(wp_get_current_user()->user_nicename)[0]->id_club;
$idUser = wp_get_current_user()->id;
$oldMessages = getMessageClub($idClub);

if (isset($_POST['message'])) {
    sendMessageClub($idClub, $idUser, $_POST['message']);
    ?> <meta http-equiv="refresh" content="0; url=https://cardio-training.eu/wp-admin/admin.php?page=message"> <?php
}

foreach ($oldMessages as $oldMessage) {
    // Trie des personnes ayant envoyés le message
    if (wp_get_current_user()->user_nicename == $oldMessage->user_nicename) {?>
      <div class="msg right-msg">
        <div class="msg-img" style="background-image: url(https://cdn-icons-png.flaticon.com/512/9586/9586796.png)">
      </div>
  <?php } else {?>
    <div class="msg left-msg">
      <div class="msg-img" style="background-image: url(https://cdn-icons-png.flaticon.com/512/9586/9586828.png)">
    </div>
    <?php }?>

    <div class="msg-bubble">
        <div class="msg-info">
          <div class="msg-info-name"><?=$oldMessage->user_nicename?></div>
          <div class="msg-info-time"><?=$oldMessage->message_time?></div>
        </div>

        <div class="msg-text">
          <?=$oldMessage->message?>
        </div>
      </div>
    </div>
<?php }?>
  </main>

  <form method="POST" class="msger-inputarea">
    <input name="message" type="text" class="msger-input" placeholder="Entrer votre message...">
    <button type="submit" class="msger-send-btn">Envoyer</button>
  </form>
</section>