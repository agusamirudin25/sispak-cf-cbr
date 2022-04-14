<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<style>
    #map {
        width: 100%;
        height: 100vh;
    }

    .leaflet-container {
        background: transparent;
    }

    .countryLabel {
        background: rgba(255, 255, 255, 0);
        border: 0;
        border-radius: 0px;
        box-shadow: 0 0px 0px;
        font-size: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #eee;
    }

    ::-webkit-scrollbar-thumb {
        background: #ccc;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #bbb;
    }

    .info {
        padding: 6px 8px;
        font: 14px/16px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    .info h4 {
        margin: 0 0 5px;
        color: #777;
    }

    .legend {
        text-align: left;
        line-height: 18px;
        color: #555;
    }

    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin-right: 8px;
        opacity: 0.7;
    }

    header {
        position: fixed;
        top: 0;
        right: 0;
        display: flex;
        color: #333;
        padding: 10px;
        align-content: center;
    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title"><?= $role ?></h4>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card widget-user m-b-20">
                        <div class="widget-user-desc p-4 text-center bg-primary position-relative">
                            <i class="fas fa-quote-left h3 text-white-50"></i>
                            <p class="text-white mb-0">Welcome <?= $role ?>.</p>
                        </div>
                        <div class="p-4">
                            <div class="float-left mt-2 mr-3">
                                <img src="<?= base_url() ?>assets/images/directory-bg.jpg" alt="" class="rounded-circle thumb-md">
                            </div>
                            <h5 class="">Integrasi <i>K-means Clustering</i> dan Sistem Informasi Geografis Daerah Rawan Bencana Alam</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card m-b-20">
                        <div class="form-group m-t-5">
                            <label class="col-sm-2 col-form-label">Jenis Bencana</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="jenis_banjir" name="jenis_banjir" onchange="ubahData(this)">
                                    <option value="banjir">Banjir</option>
                                    <option value="gempa">Gempa Bumi</option>
                                    <option value="longsor">Tanah Longsor</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chart_kecamatan"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card m-b-20">
                        <div class="form-group m-t-5">
                            <label class="col-sm-2 col-form-label">Peta</label>
                        </div>
                        <div class="card-body">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->

    </div> <!-- content -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script>
        $(document).ready(function() {
            let data = {
                kecamatan: <?= $kecamatan ?>,
                total: <?= $total ?>,
                title: "GRAFIK DATASET BENCANA BANJIR"
            }
            setGrafik(data)
        })

        function ubahData(jenis) {
            let jenis_bencana = jenis.value
            $.ajax({
                url: '<?= url() ?>Dashboard/getGrafik',
                type: 'POST',
                data: 'jenis=' + jenis_bencana,
                dataType: "json",
                success: function(res) {
                    const kecamatan = JSON.parse(res.kecamatan);
                    const total = JSON.parse(res.total);
                    const judul_anyar = res.judul
                    let data = {
                        kecamatan,
                        total,
                        title: "GRAFIK DATASET BENCANA " + judul_anyar
                    }
                    setGrafik(data)
                }
            });
        }

        function setGrafik(data) {
            //  ==== SET chart kecamatan ====
            document.getElementById('chart_kecamatan').innerHTML = '';
            var options = {
                series: [{
                    data: data.total
                }],
                chart: {
                    height: 480,
                    id: 'chart1',
                    type: 'bar',
                    events: {
                        click: function(chart, w, e) {}
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 5,
                        columnWidth: '85%',
                        distributed: true,
                    }
                },
                dataLabels: {
                    enabled: true
                },
                legend: {
                    show: false
                },
                theme: {
                    mode: 'light',
                    palette: 'palette2',
                    monochrome: {
                        enabled: false,
                        color: '#255aee',
                        shadeTo: 'light',
                        shadeIntensity: 0.65
                    },
                },
                title: {
                    text: data.title,
                    align: 'center',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '20px',
                        fontWeight: 'bold',
                        fontFamily: 'Helvetica, Arial, sans-serif',
                        color: '#008FFB'
                    },
                },
                xaxis: {
                    categories: data.kecamatan,
                    labels: {
                        style: {
                            fontSize: '10px'
                        }
                    }
                }
            };

            var chart_kecamatan = new ApexCharts(document.querySelector("#chart_kecamatan"), options);
            chart_kecamatan.render();
        }
        // Map
        var map = L.map("map").setView([-6.234039, 107.427198], 10);
        var dataBencana = [];
        var geojson = [];
        map.attributionControl.addAttribution(
            'Created by &copy; Agus Amirudin');
        getData();
        $(document).on("click", ".list-covid .list-group-item", function() {
            var id = $(this).data("id");
            var set = geojson[id];
            set.eachLayer(function(feature) {
                feature.openPopup();
                map.fitBounds(feature.getBounds());
            });
        });

        function getColor(cluster) {
            color = "#0d0";
            if (cluster == 1) {
                color = "#34A853";
            } else if (cluster == 2) {
                color = "#FBBC05";
            } else if (cluster == 3) {
                color = "#EA4335";
            }
            return color;
        }
        // atur style
        function style(f) {
            var KODE = f.properties.kode_desa;
            data = dataBencana[KODE];
            return {
                weight: 1,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 0.7,
                fillColor: getColor(data.cluster)
            };
        }
        // update jika hover
        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 1,
                color: '#f00',
                dashArray: '',
                fillOpacity: 0.7
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }

        }
        // update info
        function resetHighlight(e) {
            var layer = e.target;
            layer.setStyle({
                weight: 1,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 0.7,
            })
        }

        function onEachFeature(f, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight
            });
            layer.bindTooltip(f.properties.KECAMATAN, {
                permanent: true,
                direction: 'center',
                className: 'countryLabel'
            });
            var KODE = f.properties.kode_desa;
            // console.log(f.properties);
            data = dataBencana[KODE];
            var popUp = '<table>' +
                '<tr>' +
                '<td colspan="4"><h6>' + data.nama_kecamatan + '</h6></td>' +
                '</tr>' +
                '<tr>' +
                '<td class="bg-primary" width="20">&nbsp;</td>' +
                '<td>Banjir</td>' +
                '<td>' + data.total_banjir + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td class="bg-success"></td>' +
                '<td>Gempa Bumi</td>' +
                '<td>' + data.total_gempa + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td class="bg-danger"></td>' +
                '<td>Tanah Longsor</td>' +
                '<td>' + data.total_longsor + '</td>' +
                '</tr>' +
                '</table>';
            layer.bindPopup(popUp);

        }

        var legend = L.control({
            position: 'bottomright'
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'info legend'),
                grades = [1, 2, 3],
                labels = [],
                from, to;

            for (var i = 0; i < grades.length; i++) {
                from = grades[i];
                to = grades[i + 1];

                labels.push(
                    '<i style="background:' + getColor(from) + '"></i> Cluster ' +
                    from);
            }

            div.innerHTML = labels.join('<br>');
            return div;
        };

        legend.addTo(map);

        function getData() {
            $.ajax({
                url: '<?= url('Dashboard/getData') ?>',
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data)
                    var features = data.data_bencana;
                    for (i = 0; i < features.length; i++) {
                        var attributes = features[i];
                        var id_kecamatan = attributes.id_kecamatan;
                        dataBencana[id_kecamatan] = attributes;
                    }
                    for (i = 0; i < features.length; i++) {
                        var attributes = features[i];
                        var id_kecamatan = attributes.id_kecamatan;
                        if (id_kecamatan != 0) {
                            $.getJSON("<?= asset() . "assets/geojson/" ?>" + id_kecamatan + ".geojson", function(data) {
                                var KODE = data.features[0].properties.kode_desa;
                                geojson[KODE] = L.geoJSON(data, {
                                    onEachFeature: onEachFeature,
                                    style: style,
                                }).addTo(map);

                            });
                        }
                    }
                }
            });
        }
    </script>