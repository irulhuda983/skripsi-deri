<template>
  <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-gray-200">
    <div class="px-5 pt-5 mb-12">
      <header class="flex justify-between items-start mb-2">
        <!-- Icon -->
        <img src="../../images/icon-03.svg" width="32" height="32" alt="Icon 03" />
      </header>
      <h2 class="text-lg font-semibold text-gray-800 mb-2">Prediksi</h2>
      <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Total</div>
      <div class="flex items-start">
        <div class="text-3xl font-bold text-gray-800 mr-2">{{ total }}</div>
      </div>
    </div>
    <!-- Chart built with Chart.js 3 -->
    <!-- <div class="grow">
      <LineChart :data="chartData" width="389" height="128" />
    </div> -->
  </div>
</template>

<script>
import { ref } from 'vue'
import LineChart from '../../charts/LineChart01.vue'
import Icon from '../../images/icon-03.svg'
import EditMenu from '../../components/DropdownEditMenu.vue'

// Import utilities
import { tailwindConfig, hexToRGB } from '../../utils/Utils'

export default {
  name: 'DashboardCard01',
  components: {
    LineChart,
    EditMenu,
  },
  props: ['total'],
  setup() {
    const chartData = ref({
      labels: [
        '12-01-2020', '01-01-2021', '02-01-2021',
        '03-01-2021', '04-01-2021', '05-01-2021',
        '06-01-2021', '07-01-2021', '08-01-2021',
        '09-01-2021', '10-01-2021', '11-01-2021',
        '12-01-2021', '01-01-2022', '02-01-2022',
        '03-01-2022', '04-01-2022', '05-01-2022',
        '06-01-2022', '07-01-2022', '08-01-2022',
        '09-01-2022', '10-01-2022', '11-01-2022',
        '12-01-2022', '01-01-2023',
      ],
      datasets: [
        // Indigo line
        {
          data: [
            540, 466, 540, 466, 385, 432, 334,
            334, 289, 289, 200, 289, 222, 289,
            289, 403, 554, 304, 289, 270, 134,
            270, 829, 344, 388, 364,
          ],
          fill: true,
          backgroundColor: `rgba(${hexToRGB(tailwindConfig().theme.colors.blue[500])}, 0.08)`,
          borderColor: tailwindConfig().theme.colors.indigo[500],
          borderWidth: 2,
          tension: 0,
          pointRadius: 0,
          pointHoverRadius: 3,
          pointBackgroundColor: tailwindConfig().theme.colors.indigo[500],
          clip: 20,
        },
        // Gray line
        {
          data: [
            689, 562, 477, 477, 477, 477, 458,
            314, 430, 378, 430, 498, 642, 350,
            145, 145, 354, 260, 188, 188, 300,
            300, 282, 364, 660, 554,
          ],
          borderColor: tailwindConfig().theme.colors.gray[300],
          borderWidth: 2,
          tension: 0,
          pointRadius: 0,
          pointHoverRadius: 3,
          pointBackgroundColor: tailwindConfig().theme.colors.gray[300],
          clip: 20,
        },
      ],
    })

    return {
      chartData,
    } 
  }
}
</script>