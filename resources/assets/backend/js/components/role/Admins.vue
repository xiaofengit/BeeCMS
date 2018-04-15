<template>
	<div>
		<!-- 面包屑 -->
		<el-breadcrumb separator-class="el-icon-arrow-right">
            <el-breadcrumb-item><router-link to="/">工作面板</router-link></el-breadcrumb-item>
            <el-breadcrumb-item><router-link to="/admins">权限管理</router-link></el-breadcrumb-item>
            <el-breadcrumb-item>管理员</el-breadcrumb-item>
        </el-breadcrumb>

        <!-- 数据 -->
		<el-table
			style="width:100%"
			:data="tableData"
			stripe
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
        batchSelected: '',
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
				]
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
      }
		}
	}
</script>