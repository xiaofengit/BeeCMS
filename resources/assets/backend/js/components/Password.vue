<template>
    <div>
        <el-breadcrumb separator-class="el-icon-arrow-right">
            <el-breadcrumb-item><router-link to="/">工作面板</router-link></el-breadcrumb-item>
            <el-breadcrumb-item>修改密码</el-breadcrumb-item>
        </el-breadcrumb>

        <el-form label-width="100px" class="edit-form" :model="form" :rules="rules" ref="passwordform">
            <el-form-item ref='old_password' prop="old_password" class="input" label="旧密码" :error="''">
                <el-input v-model="form.old_password" name="old_password" type="password" placeholder=""></el-input>
            </el-form-item>
            <el-form-item ref='password' prop="password" class="input" label="新密码">
                <el-input v-model="form.password" name="password" type="password" placeholder=""></el-input>
            </el-form-item>
            <el-form-item ref='password_confirmation' prop="password_confirmation" class="input" label="确认新密码">
                <el-input v-model="form.password_confirmation" name="password_confirmation" type="password" placeholder=""></el-input>
            </el-form-item>

            <el-form-item>
                <el-button type="primary" @click="submitForm('passwordform')" v-loading.lock="loading">提 交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    export default {
        data: function() {
            var checkPasswordConfirmation = (rule, value, callback) => {
                if (value !== this.form.password) {
                    callback(new Error('两次输入的密码不一致'));
                }
                callback();
            };
            return {
                loading: false,
                form: {
                    old_password: '',
                    password: '',
                    password_confirmation: ''
                },
                rules: {
                    old_password: [
                        {required: true, message: '请输入旧密码', trigger: 'blur, change'}
                    ],
                    password: [
                        {required: true, min:6, message: '请输入不少于6位的新密码', trigger: 'blur, change'}
                    ],
                    password_confirmation: [
                        {required: true, message: '请输入再次新密码', trigger: 'blur'},
                        {validator: checkPasswordConfirmation, trigger: 'blur, change'}
                    ]
                }
            };
        },
        methods: {
            submitForm(formName) {
                if (!this.loading) {
                    this.$refs[formName].validate((valid) => {
                        if (valid) {
                            var _v = this;
                            _v.loading = true;
                            // 请求修改密码
                            axios.post('/backend/password', _v.form).then(function(response) {
                                _v.loading = false;
                                console.log(response);
                                _v.$message.success(response.data.message);
                                _v.$refs[formName].resetFields();
                            })
                            .catch(function(error) {
                                if (error.response) {
                                    var errors = error.response.data.errors || {};
                                    console.log(errors);
                                    switch (error.response.status) {
                                        case 422:
                                            for ( var item in errors) {
                                                _v.$message.error(errors[item][0]);
                                                break;
                                            }
                                            break;
                                        default:
                                            _v.$message.error(error.response.data.message);
                                            break;
                                    }
                                } else {
                                    _v.$message.error(error.message);
                                }
                                _v.loading = false;
                            });
                        }
                    });
                }
            }
        }
    }
</script>
