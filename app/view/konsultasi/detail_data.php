<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-chat">
                    <div class="nk-chat-body">
                        <div class="nk-chat-head">
                            <ul class="nk-chat-head-info">
                                <li class="nk-chat-body-close">
                                    <a href="#" class="btn btn-icon btn-trigger nk-chat-hide ml-n1"><em class="icon ni ni-arrow-left"></em></a>
                                </li>
                                <li class="nk-chat-head-user">
                                    <div class="user-card">
                                        <div class="user-info">
                                            <div class="lead-text"><?= session_get('type') == 3 ? 'Pakar' : $konsultasi->nama_lengkap ?></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- .nk-chat-head -->
                        <div class="nk-chat-panel" data-simplebar="init">
                            <div class="simplebar-wrapper" style="margin: -20px -28px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 20px 28px;">
                                            <input type="hidden" name="id" id="id_konsultasi" value="<?= $id_konsultasi ?>">
                                                <div class="chat <?= session_get('type') == 3 ? 'is-me' : 'is-you' ?>">
                                                    <div class="chat-content">
                                                        <div class="chat-bubbles">
                                                            <div class="chat-bubble">
                                                                <div class="chat-msg"> <?= $konsultasi->pertanyaan ?> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .chat -->
                                                <?php foreach($jawaban as $row) : ?>
                                                    <?php if(session_get('type') == 3) : ?>
                                                    <div class="<?= $row['pakar'] == 1 ? 'chat is-you' : 'chat is-me' ?>">
                                                        <div class="chat-content">
                                                            <div class="chat-bubbles">
                                                                <div class="chat-bubble">
                                                                    <div class="chat-msg"><?= $row['jawaban'] ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php else : ?>
                                                    <div class="<?= $row['pakar'] == 1 ? 'chat is-me' : 'chat is-you' ?>">
                                                        <div class="chat-content">
                                                            <div class="chat-bubbles">
                                                                <div class="chat-bubble">
                                                                    <div class="chat-msg"><?= $row['jawaban'] ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <div class="chat is-me wrapper-chat" style="display: none;">
                                                    <div class="chat-content">
                                                        <div class="chat-bubbles">
                                                            <div class="chat-bubble">
                                                                <div class="chat-msg" id="after-pesan"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 776px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar" style="height: 25px; transform: translate3d(0px, 9px, 0px); display: block;"></div>
                            </div>
                        </div><!-- .nk-chat-panel -->
                        <div class="nk-chat-editor">
                            <div class="nk-chat-editor-form">
                                <div class="form-control-wrap">
                                    <textarea class="form-control form-control-simple no-resize" name="pesan" id="pesan" rows="1" id="default-textarea" placeholder="Tulis pesan konsultasi..."></textarea>
                                </div>
                            </div>
                            <ul class="nk-chat-editor-tools g-2">
                                <li>
                                    <button type="submit" id="kirim" class="btn btn-round btn-primary btn-icon"><em class="icon ni ni-send-alt"></em></button>
                                </li>
                            </ul>
                        </div><!-- .nk-chat-editor -->
                    </div><!-- .nk-chat-body -->
                </div><!-- .nk-chat -->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#kirim').click(function(e){
            e.preventDefault();
            var pesan = $('#pesan').val();
            var id_konsultasi = $('#id_konsultasi').val();
            $.ajax({
                url: '<?= base_url('konsultasi/prosesJawaban') ?>',
                type: 'POST',
                data: {pesan: pesan, id_konsultasi: id_konsultasi},
                success: function(data){
                    let response = JSON.parse(data);
                    let pesan = response.pesan;
                    $('#pesan').val('');
                    $('.wrapper-chat').show();
                    $('#after-pesan').html(pesan);
                }
            });
        });
    });
</script>