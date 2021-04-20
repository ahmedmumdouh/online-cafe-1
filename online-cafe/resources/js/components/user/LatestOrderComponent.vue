<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Latest Order</div>
                    <div class="card-body">
                        <h3>Order Details</h3>
                    </div>
                    <div class="card-body">
                        <h3>Order Details</h3>
                    </div>
                    <div class="card-body">
                        {{ user }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    methods: {

    },
    props: ['user']
}
</script>