<template>
  <div>
    <!-- 面包屑 -->
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item><router-link to="/admin">权限管理</router-link></el-breadcrumb-item>
      <el-breadcrumb-item><router-link to="/admin">管理员</router-link></el-breadcrumb-item>
      <el-breadcrumb-item>新 增</el-breadcrumb-item>
    </el-breadcrumb>

    <!-- 表单 -->
    <el-form label-width="100px" class="edit-form" :model="form" :rules="rules" ref="form">
      <el-form-item ref='name' prop="name" class="input" label="姓 名" :error="''">
        <el-input v-model="form.name" name="name" type="text" placeholder=""></el-input>
      </el-form-item>
      <el-form-item ref='email' prop="email" class="input" label="邮 箱">
        <el-input v-model="form.email" name="email" type="email" placeholder=""></el-input>
      </el-form-item>
      <el-form-item ref='password' prop="password" class="input" label="登录密码">
        <el-input v-model="form.password" name="password" :type="showPwd == false ? 'password' : 'text'" placeholder="">
          <template slot="append"><i @click="showPwd = !showPwd" style="cursor: pointer;">{{showPwd == false ? '显示' : '隐藏'}}</i></template>
        </el-input>
      </el-form-item>
      <el-form-item prop="is_active" label="状 态">
        <el-switch v-model="form.is_active"></el-switch>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="submitForm('form', true)" v-loading.lock="loading">保存&返回</el-button>
        <el-button type="primary" @click="submitForm('form')" v-loading.lock="loading">保存&继续</el-button>
        <el-button type="default" @click="resetForm('form')" >重 置</el-button>
        <el-button type="default" @click="hanlderBack()" >返 回</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
  export default {
    data: function() {
      return {
        showPwd: true,
        loading: false,
        form: {
          name: '',
          email: '',
          password: '',
          is_active: true
        },
        rules: {
          name: [
            {required: true, message: '请输入姓名', trigger: 'blur'}
          ],
          email: [
            {required: true, message: '请输入邮箱', trigger: 'blur'},
            {type: 'email', message: '请输入正确的邮箱', trigger: 'blur'}
          ],
          password: [
            {required: true, min:6, message: '请输入登录密码', trigger: 'blur'},
          ],
          is_active: [
            {required: true, message: '请选择账号状态', trigger: 'change'},
          ]
        }
      }
    },
    methods: {
      submitForm: function(formName, back) {
        this.$refs[formName].validate((valid) => {
          if (valid && this.loading == false) {
            this.loading = true;
            axios.post('/backend/admin', this.form)
              .then(res => {
                console.log(res)
                this.$message.success(res.data.message || 'success');
                if (back) {
                  this.$router.back();
                } else {
                  this.$refs[formName].resetFields();
                }
                this.loading = false;
              })
              .catch(error => {
                if (error.response.status == 422) {
                  let errors = error.response.data.errors || {};
                  for ( var item in errors) {
                    this.$message.error(errors[item][0]);
                    break;
                  }
                } else {
                  this.$message.error(error.message);
                }
                this.loading = false;
              })
          }
        })
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      },
      hanlderBack() {
        this.$router.back();
      }
    }
  }
</script>
