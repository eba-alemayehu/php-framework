<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php use Application\Framework\Support\Auth; ?>
<?php if(Auth::check()): ?>

    <?php if(Auth::user()->setup == 0): ?>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change password</h5>
                    </div>
                    <div class="modal-body">
                        <div class="contaier">
                            <form action="/change password" method="post" id="change-password-form">
                                <div class="alert alert-danger" style="display: none">
                                    <p id="match" style="display: none">Password confirmation dosen't match</p>
                                    <p id="error"style="display: none">Some error occured</p>
                                </div>
                                <div class="alert alert-success" style="display: none">
                                    <p>You hava successfuly changed your password</p>
                                </div>
                                <div class="from-group form">
                                    <label for="password">Password</label>
                                    <input type="password" autofocus name="password" id="password" class="form-control"/>
                                </div>
                                <div class="from-group form">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password" name="confirm password" id="confirm-password" class="form-control"/>
                                </div>
                                <div class="from-group form">
                                    <br>
                                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                                </div>
                            </form>
                            <div id="ok" style="display:none">
                                <br>
                                <button type="submit" class="btn btn-primary float-right" data-dismiss="modal">OK</button>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        <script>

            $("#exampleModalCenter").modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            function pass_match(){
                var password = $("#change-password-form #password").val();
                var confirmPassword = $("#change-password-form #confirm-password").val();
                return (password == confirmPassword);
            }
            $("#change-password-form").on("submit", function(e){
                e.preventDefault();
                var password = $("#change-password-form #password").val();
                $("#change-password-form .alert").hide();
                $("#change-password-form .alert-danger>p").hide();
                if(pass_match()){
                    $.post("change password?password="+password)
                        .done(function(){
                            $("#change-password-form .alert-success").show();
                            $(".form").hide();
                            $("#ok").show();
                            $("#exampleModalCenter").modal({
                                backdrop: true,
                                keyboard: true,
                                show: true
                            });
                        })
                        .fail(function(){
                            $("#change-password-form .alert-danger>#error").show();
                        });
                }else{
                    $("#change-password-form .alert-danger>#match").show();
                }

                return false;
            })
        </script>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>