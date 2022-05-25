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
                                            <div class="lead-text">Pakar</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                           
                            <div class="nk-chat-head-search">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-search"></em>
                                        </div>
                                        <input type="text" class="form-control form-round" id="chat-search" placeholder="Search in Conversation">
                                    </div>
                                </div>
                            </div><!-- .nk-chat-head-search -->
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
                                                <div class="chat is-me wrapper-chat" style="display: none;">
                                                    <div class="chat-content">
                                                        <div class="chat-bubbles">
                                                            <div class="chat-bubble">
                                                                <div class="chat-msg" id="after-pesan"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .chat -->
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
            $.ajax({
                url: '<?= base_url('konsultasi/prosesTambahKonsultasi') ?>',
                type: 'POST',
                data: {pesan: pesan},
                success: function(data){
                    console.log(data);
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