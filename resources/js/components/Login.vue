<template>
    <div class="modal fade sign-in auth" id="sign-in-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header no-border">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="modal-title">
                                    <h5 class="font-weight-bold text-custom-baby-blue">Login</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <form method="POST" action="{{ route('login') }}">
                                    <div class="form-group">
                                        <label for="emailAddress" class="text-custom-black-soft font-weight-bold">Email Address</label>
                                        <input type="email" class="form-control" id="emailAddress" placeholder="example@email.com" name="email" v-model="signin.email" required=""/>
                                        <div class="invalid-feedback"><i class="fas fa-exclaimation"></i> This field is required</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="text-custom-black-soft font-weight-bold">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="" name="password" v-model="signin.password" required=""/>
                                        <div class="invalid-feedback"><i class="fas fa-exclaimation"></i> This field is required</div>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="rememberMe"/>
                                        <label class="form-check-label text-custom-extra-muted" for="rememberMe">Remember Me</label>
                                    </div>
                                    <button type="button" v-on:click="login()" class="btn bg-custom-secondary text-white font-weight-semi-bold px-5">Sign In</button>
                                    <a href="#" class="text-custom-extra-muted font-weight-bold ml-3 small" data-toggle="modal" data-target="#password-reset-modal" data-dismiss="modal"><u>Forgot Password?</u></a>
                                    <p class="mt-3 text-custom-extra-muted font-weight-semi-bold small">Don't have an account? <a href="#" class="text-custom-secondary font-weight-bold" data-toggle="modal" data-target="#register-modal" data-dismiss="modal"><u>Sign up here</u></a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Login',
        data() {
            return {
                input: {
                    username: "",
                    password: ""
                }
            }
        },
        methods: {
            login() {
                if(this.signin.email !== "" && this.signin.password !== "") {
                    if(this.signin.email === this.$parent.mockAccount.username && this.signin.password === this.$parent.mockAccount.password) {
                        this.$emit("authenticated", true);
                        this.$router.replace({ name: "secure" });
                    } else {
                        console.log("The username and / or password is incorrect");
                    }
                } else {
                    console.log("A username and password must be present");
                }
            }
        }
    }
</script>
