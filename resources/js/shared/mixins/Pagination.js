export default {
    data() {
        
        return {
             currentPage: 1,
            itemPerpage: 4,
        }
    },
    computed: {
        //visiblePaginationRows
        visiblePaginationRows() {
            const startPage = (this.currentPage - 1) * this.itemPerpage;
            const endPage = startPage + this.itemPerpage;
            if (this.searchResult) {
                return this.searchResult.slice(startPage, endPage);
            }
            else if(this.bookables) {
                return this.bookables.slice(startPage, endPage);
            }
            else if (this.shops) {
                return this.shops.slice(startPage, endPage);
            }
            
        },
        visiblePageNumbers() {
            let pageNumbers = [];
            if (this.totalPages <= 9) {
                for (let i = 1; i <= this.totalPages; i++){
                    pageNumbers.push(i);
                 }
            } else {
                if (this.currentPage <= 4) {
                    pageNumbers = [1, 2, 3, 4, 5, ".....", this.totalPages];

                } else if (this.currentPage >= this.totalPages - 3) {
                    pageNumbers = [1, "....", this.totalPages - 4,
                        this.totalPages - 3, this.totalPages - 2, this.totalPages - 1, this.totalPages];
                } else {
                    pageNumbers = [1, "....", this.currentPage - 1, this.currentPage, this.currentPage + 1, ".....", this.totalPages];
               }
            }

            return pageNumbers;
        },
        totalPages() {
            if (this.bookables) {
                return Math.ceil(this.bookables.length / this.itemPerpage);
            }
            else if (this.shops) {
                return Math.ceil(this.shops.length / this.itemPerpage);
            }

        }

    },

    methods: {
         changePage(page) {
            if (page >=1 && page <= this.totalPages) {
                this.currentPage = page; 
            }
        },
    }
}