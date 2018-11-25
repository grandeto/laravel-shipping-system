<template>
    <el-col>
        <el-table
            :data="prices"
            stripe
            border
            :empty-text="noShippments"
            ref="shippmentTable"
            class="table-shippments">
            <el-table-column
                label="#"
                prop="id"
                width="70">
            </el-table-column>
            <el-table-column
                label="Shipping method"
                prop="method_id"
                width="200">
            </el-table-column>
            <el-table-column
                label="Origin Country"
                prop="origin_country_id"
                width="200">
            </el-table-column>
            <el-table-column
                label="Destination Country"
                prop="destination_country_id"
                width="200">
            </el-table-column>
            <el-table-column
                label="Min Weight"
                prop="min_weight"
                width="100">
            </el-table-column>
            <el-table-column
                label="Max Weight"
                prop="max_weight"
                width="100">
            </el-table-column>
            <el-table-column
                label="Price ($)"
                prop="price"
                width="100">
            </el-table-column>
        </el-table>
    </el-col>
</template>

<script>
export default {
    name: 'shippments',
    props: ['noShippments', 'prices']
}
</script>

