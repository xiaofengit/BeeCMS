<template>
	<div>
		<!-- 面包屑 -->
		<el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item><router-link to="/admins">权限管理</router-link></el-breadcrumb-item>
      <el-breadcrumb-item>管理员</el-breadcrumb-item>
    </el-breadcrumb>

    <!-- 搜索 -->
    <el-form :model="search" :inline="true" ref="searchForm" :rules="searchRules" class="search-form-inline">
      <el-form-item prop="name" class="input" label="姓名">
        <el-input v-model="search.name" type="input" placeholder="请输入姓名"></el-input>
      </el-form-item>
      <el-form-item prop="email" class="input" label="邮箱">
        <el-input v-model="search.email" type="input" placeholder="请输入邮箱"></el-input>
      </el-form-item>
      <el-form-item prop="is_active" label="状态">
        <el-select v-model="search.is_active">
          <el-option label="全部" value="-1"></el-option>
          <el-option label="启用" value="1"></el-option>
          <el-option label="禁用" value="0"></el-option>
        </el-select>
      </el-form-item>
      <el-form-item prop="created_at" class="input" label="创建时间">
        <el-date-picker
          v-model="search.created_at"
          type="datetimerange"
          range-separator="至"
          start-placeholder="开始日期"
          end-placeholder="结束日期">
        </el-date-picker>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="handleSearch('searchForm')" v-loading.lock="loading">搜 索</el-button>
      </el-form-item>
    </el-form>

    <!-- 操作按钮 -->
    <el-button-group class="table-button-group">
      <el-button type="primary" size="mini" icon="el-icon-plus">新 增</el-button>
      <el-button type="primary" size="mini" icon="el-icon-download">导 出</el-button>
    </el-button-group>

    <!-- 数据 -->
		<el-table
			style="width:100%"
			:data="tableData"
			stripe
      border
			class="data-table"
		>
			<el-table-column
				type="selection"
			></el-table-column>
			<el-table-column
				prop="id"
				label="ID"
				width="50"
			></el-table-column>
			<el-table-column
				prop="name"
				label="姓名"
			></el-table-column>
			<el-table-column
				prop="email"
				label="邮箱"
			></el-table-column>
			<el-table-column
				prop="is_super"
				label="超级管理员"
				:formatter="formatSuper"
			></el-table-column>
			<el-table-column
				prop="is_active"
				label="状态"
				:formatter="formatState"
			></el-table-column>
			<el-table-column
				prop="created_at"
				label="创建时间"
			></el-table-column>
			<el-table-column
				prop="updated_at"
				label="更新时间"
			></el-table-column>
			<el-table-column
				label="操作"
				fixed="right"
				min-width="150"
			>
				<template slot-scope="scope">
					<el-button
						size="mini"
						@click="hanldeEdit(scope.$index, scope.row)"
					>编辑</el-button>
					<el-button
						size="mini"
						type="danger"
						@click="hanldeDelete(scope.$index, scope.row)"
						:disabled="scope.row.is_super == 1 ? true : false"
					>删除</el-button>
				</template>
			</el-table-column>
		</el-table>


    <div class="data-table-footer">
      <!-- 批量操作 -->
      <div class="table-batch">
        <el-select v-model="batchSelected" placeholder="批量操作" size="medium" style="width: 110px;">
          <el-option
            v-for="item in batchOptions"
            :key="item.value"
            :label="item.label"
            :value="item.value">
          </el-option>
        </el-select>
        <el-button>确定</el-button>
      </div>
      <!-- 分页 -->
      <el-pagination
        class="table-pagination"
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
        :current-page="1"
        :page-sizes="[10, 20, 50, 100, 200, 300]"
        :page-size="10"
        layout="total, sizes, prev, pager, next"
        :total="5"
        background>
      </el-pagination>
    </div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
        loading: false,
        search: {
          name: "",
          email: "",
          created_at: ""
        },
        searchRules: {
          email: {type: "email", message: "请输入正确的邮箱", trigger: "blur"}
        },
				tableData: [
					{
						id: 1,
						email: "aa@ss.com",
						name: "姓名",
						is_super: 0,
						is_active: 1,
						created_at: "",
						updated_at: ""
					},
					{
						id: 1,
						email: "aa@ss.com",
						name: "姓名",
						is_super: 1,
						is_active: 0,
						created_at: "",
						updated_at: ""
					},
					{
						id: 1,
						email: "aa@ss.com",
						name: "姓名",
						is_super: 0,
						is_active: 1,
						created_at: "",
						updated_at: ""
					},
					{
						id: 1,
						email: "aa@ss.com",
						name: "姓名",
						is_super: 1,
						is_active: 0,
						created_at: "",
						updated_at: ""
					},
					{
						id: 1,
						email: "aa@ss.com",
						name: "姓名",
						is_super: 0,
						is_active: 1,
						created_at: "",
						updated_at: ""
					},
					{
						id: 1,
						email: "aa@ss.com",
						name: "姓名",
						is_super: 1,
						is_active: 0,
						created_at: "",
						updated_at: ""
					}
				],
        batchOptions: [
          {
            value: "disabled",
            label: "禁用",
          },
          {
            value: "enable",
            label: "启用",
          }
        ],
        batchSelected: ''
			}
		},
		methods: {
			formatSuper: function(row, column, cellValue, index) {
				return cellValue == 1 ? "是" : "否"
			},
			formatState: function(row, column, cellValue, index) {
				return cellValue == 1 ? "激活" : "禁用"
			},
			hanldeEdit: function(index, row) {
				console.log(index, row)
			},
			hanldeDelete: function(index, row) {
				console.log(index, row)
				this.$confirm("此操作将永久删除该记录，是否继续？", "提示", {
					confirmButtonText: "确定",
					cancelButtonTextt: "取消",
					type: 'warning'
				}).then(() => {
          this.tableData.splice(index, 1)
					this.$message({
            type: 'success',
            message: '删除成功!'
          });
				}).catch(() => {
					// this.$message('已取消删除');
				})
			},
      handleSizeChange(val) {
        console.log(`每页 ${val} 条`);
      },
      handleCurrentChange(val) {
        console.log(`当前页: ${val}`);
      },
      handleSearch: function(formName) {

      }
		}
	}
</script>
