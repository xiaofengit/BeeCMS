<template>
    <el-menu
        class="el-menu-vertical-demo"
        :collapse="collapse"
        :unique-opened="true">
        <el-submenu index="1">
            <template slot="title">
                <i class="el-icon-document"></i>
                <span>内容管理</span>
            </template>
            <el-menu-item index="4"><a href="#">文档分类</a></el-menu-item>
            <el-menu-item index="5"><a href="#">文档管理</a></el-menu-item>
            <el-menu-item index="1-3"><a href="#">广告管理</a></el-menu-item>
        </el-submenu>
        <el-submenu index="2">
            <template slot="title">
                <i class="el-icon-view"></i>
                <span>权限管理</span>
            </template>
            <el-menu-item index="2-1"><router-link to="/admin">管理员</router-link></el-menu-item>
            <el-menu-item index="2-2"><router-link to="/permission">管理员组</router-link></el-menu-item>
        </el-submenu>
        <el-submenu index="3">
            <template slot="title">
                <i class="el-icon-setting"></i>
                <span>系统设置</span>
            </template>
            <el-menu-item index="3-1"><a href="#">网站设置</a></el-menu-item>
        </el-submenu>
    </el-menu>
</template>
<script>
    export default {
        data() {
            return {
                //collapse: false
            };
        },
        props: ['collapse']
    }
</script>
