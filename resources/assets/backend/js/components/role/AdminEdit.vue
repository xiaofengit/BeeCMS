<template>
  <div>
    <!-- 面包屑 -->
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item><router-link to="/admin">权限管理</router-link></el-breadcrumb-item>
      <el-breadcrumb-item><router-link to="/admin">管理员</router-link></el-breadcrumb-item>
      <el-breadcrumb-item>编 辑</el-breadcrumb-item>
    </el-breadcrumb>

    <!-- 表单 -->
    <el-form label-width="100px" class="edit-form" :model="form" :rules="rules" ref="form" v-loading.lock="loading">
      <el-form-item ref='name' prop="name" class="input" label="姓 名" :error="''">
        <el-input v-model="form.name" name="name" type="text" placeholder=""></el-input>
      </el-form-item>
      <el-form-item ref='email' prop="email" class="input" label="邮 箱">
        <el-input v-model="form.email" name="email" type="email" placeholder=""></el-input>
      </el-form-item>
      <el-form-item ref='password' prop="password" class="input" label="登录密码" >
        <el-input v-model="form.password" name="password" :type="showPwd == false ? 'password' : 'text'" placeholder="留空则不修改密码">
          <template slot="append"><i @click="showPwd = !showPwd" style="cursor: pointer;">{{showPwd == false ? '显示' : '隐藏'}}</i></template>
        </el-input>
      </el-form-item>
      <el-form-item prop="is_active" label="状 态">
        <el-switch v-model="form.is_active"></el-switch>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="submitForm('form', true)" v-loading.lock="loading">保存&返回</el-button>
        <el-button type="primary" @click="submitForm('form')" v-loading.lock="loading">保存&继续</el-button>
        <!-- <el-button type="default" @click="resetForm('form')" >重 置</el-button> -->
        <el-button type="default" @click="hanlderBack()" >返 回</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
  export default {
    beforeMount: function() {
      // 获取数据
      // this.$loading();
      axios.get('/backend/admin/'+this.$route.params.id)
      .then(res => {
        if (res.data) {
          this.form.name = res.data.name;
          this.form.email = res.data.email;
          this.form.is_active = res.data.is_active == 1 ? true : false;
          this.loading = false;
        }
      })
      .catch(error => {
        this.$message.error(error.message);
        // setTimeout(() => {this.$router.push('/admin');this.$loading().close();}, 1000);
      })
    },
    data: function() {
      return {
        showPwd: true,
        loading: true,
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
            {required: false, min:6, message: '登录密码不能少于6位', trigger: 'blur'},
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
            axios.patch('/backend/admin/'+this.$route.params.id, this.form)
              .then(res => {
                this.$message.success(res.data.message || 'success');
                if (back) {
                  this.$router.back();
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
