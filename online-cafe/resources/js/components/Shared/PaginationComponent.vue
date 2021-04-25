<template>
    <!-- Pagination Start -->
        <div class="row justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li :class="['page-item', next.url == null ?'disabled' : '']">
                    <a class="page-link" href="#" @click.prevent="sendPageUrl(next.url)"  aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <li   v-for="link in allPages" :key="link" class="page-item"><a @click.prevent="!link.active ? sendPageUrl(link.url): ''" class="page-link" href="#">{{link.label}}</a></li>
                    
                    <li :class="['page-item', previous.url == null ?'disabled' : '']">
                    <a class="page-link" href="#" @click.prevent="sendPageUrl(previous.url)" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Pagination End  -->
</template>

<script>
import service from '../../services/orders';

export default {
    data() {
        return {
            next: this.links.shift(),
            previous: this.links.pop(),
            allPages: this.links,
        }
    },
    methods:{
       async sendPageUrl(url){
           const result = await service.getPage(url);
            this.updateLinks(result.data.links);
            this.$emit('paginate', result);
        },
        updateLinks(links){
            links.forEach((link, index) => {
                    this.links[index] =link;
                });
                this.next =  this.links.shift();
                this.previous = this.links.pop();
                this.allPages = this.links;
        },
    },
    props:['links', 'nextAndPrevious']
}
</script>