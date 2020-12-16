<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Agencie</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th class='sort-title' scope="col" @click="ratingSort">Rating <font-awesome-icon :icon="this.rateAsc? ['fas', 'arrow-down'] : ['fas', 'arrow-up'] " /></th>
        <th class='sort-title' scope="col" @click="dateTimeSort">datetime <font-awesome-icon :icon="this.dateAsc? ['fas', 'arrow-down'] : ['fas', 'arrow-up'] " /></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in news" :key="item.id">
        <td scope="col">{{index+1}}</td>
        <td scope="col">{{ item.agencie }}</td>
        <td scope="col">{{ item.title }}</td>
        <td scope="col">{{ item.content }}</td>
        <td scope="col">{{ item.rating }}</td>
        <td scope="col">{{ item.datetime }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  data() {
    return {
      dateAsc: true,
      rateAsc: false,
      dailyNews: [],
      news: [],
    };
  },
  methods: {
    dateTimeSort() {
      if (this.dateAsc) {
        this.news.sort((a, b) => {
          return new Date(b.datetime) - new Date(a.datetime);
        });
      } else {
        this.news.sort((a, b) => {
          return new Date(a.datetime) - new Date(b.datetime);
        });
      }

      this.dateAsc = !this.dateAsc;
    },

    getRateInInt(rate) {
      rate = parseInt(rate.substring(0, rate.indexOf("/")));
      console.log(rate);
      return rate;
    },
    ratingSort() {
      if (this.rateAsc) {
        this.news.sort((a, b) => {
          return this.getRateInInt(b.rating) - this.getRateInInt(a.rating);
        });
      } else {
        this.news.sort((a, b) => {
          return this.getRateInInt(a.rating) - this.getRateInInt(b.rating);
        });
      }

      this.rateAsc = !this.rateAsc;
    },
  },
  computed: {},
  mounted() {
    axios.get("/api/dailyNews").then((res) => {
      this.dailyNews = res.data;
      for (let i of this.dailyNews) {
        for (let j of i.latestnews) {
          j.agencie = i.name;
        }
        this.news.push(...i.latestnews);
      }
      this.ratingSort();
    });
  },
};
</script>
<style scoped>
.sort-title:hover{
    cursor: pointer;
}
</style>
