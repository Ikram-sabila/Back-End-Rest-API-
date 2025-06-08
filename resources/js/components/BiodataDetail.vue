<template>
    <div v-if="biodata" class="biodata-card">
        <h2>{{ biodata.nama }}</h2>
        <img v-if="biodata.foto" :src="fotoUrl" alt="Foto" class="foto" />

        <p><strong>Alamat:</strong> {{ biodata.alamat }}</p>
        <p><strong>Tanggal Lahir:</strong> {{ biodata.tanggal_lahir }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ biodata.jenis_kelamin }}</p>
        <p><strong>No HP:</strong> {{ biodata.no_hp }}</p>

        <hr />

        <h3>Riwayat Kuliah</h3>
        <ul>
            <li v-for="kul in biodata.kuliah" :key="kul.id">
                {{ kul.nama_kampus }} - {{ kul.jurusan }} ({{ kul.tahun_masuk }} - {{ kul.tahun_lulus || 'Sekarang' }})
            </li>
        </ul>

        <h3>Pengalaman Kerja</h3>
        <ul>
            <li v-for="peng in biodata.pengalaman" :key="peng.id">
                {{ peng.nama_perusahaan }} - {{ peng.posisi }} ({{ peng.tahun_mulai }} - {{ peng.tahun_selesai ||
                'Sekarang' }})
            </li>
        </ul>
    </div>

    <div v-else>
        <p>Memuat data biodata...</p>
    </div>
</template>

<script>
export default {
    name: 'BiodataDetail',
    props: {
        biodataId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            biodata: null,
        };
    },
    computed: {
        fotoUrl() {
            return this.biodata?.foto ? `http://localhost:8000/storage/${this.biodata.foto}` : null;
        },
    },
    mounted() {
        this.fetchBiodata();
    },
    methods: {
        async fetchBiodata() {
            try {
                const response = await fetch(`/api/biodata/2`);
                const data = await response.json();
                this.biodata = data.biodata;
            } catch (error) {
                console.error('Gagal memuat biodata:', error);
            }
        },
    },
};
</script>

<style>
.biodata-card {
    border: 1px solid #ccc;
    padding: 20px;
    margin: 30px auto;
    max-width: 600px;
    border-radius: 10px;
    background-color: #f9f9f9;
}

.biodata-card h2 {
    margin-top: 0;
    color: #333;
}

.biodata-card img.foto {
    display: block;
    margin-bottom: 15px;
    max-width: 150px;
    height: auto;
    border-radius: 8px;
    border: 1px solid #aaa;
}

.biodata-card h3 {
    margin-top: 20px;
    color: #444;
}

.biodata-card ul {
    padding-left: 20px;
}

.biodata-card li {
    margin-bottom: 8px;
}
</style>
