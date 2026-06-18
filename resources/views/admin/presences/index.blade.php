@extends('layouts.admin')

@section('title', 'Liste des présences')
@section('page-title', 'Liste des présences')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Bloc d'en-tête et Sélecteur -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="sm:flex sm:items-center sm:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Suivi des Présences</h1>
                <p class="text-sm text-slate-500 mt-1">Sélectionnez une session pour afficher, filtrer ou exporter les pointages associés.</p>
            </div>
        </div>

        <div class="max-w-xs">
            <label for="session_select" class="block text-sm font-medium text-slate-700 mb-1.5">
                Session de présence
            </label>
            <select id="session_select"
                onchange="loadPresences(this.value)"
                class="block w-full px-4 py-2.5 text-sm border border-slate-300 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                <option value="">-- Choisir une session --</option>
                @foreach($sessions as $session)
                <option value="{{ $session->id }}">
                    {{ $session->titre ?? 'Session du ' . $session->created_at->format('d/m/Y H:i') }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Conteneur Principal de la Table (Masqué initialement) -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hidden" id="presences-container">

        <!-- Barre d'outils du tableau -->
        <div class="p-4 bg-slate-50/70 border-b border-slate-100 sm:flex sm:items-center sm:justify-between space-y-2 sm:space-y-0">
            <span class="text-xs font-semibold text-slate-700 uppercase tracking-wider" id="presence-count">
                0 présence(s) trouvée(s)
            </span>

            <div class="flex items-center space-x-2">
                <!-- Exporter Excel -->
                <button onclick="exportToExcel()"
                    class="inline-flex items-center px-3 py-2 border border-slate-200 rounded-xl shadow-sm text-xs font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors">
                    <svg class="h-4 w-4 text-emerald-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Exporter Excel
                </button>

                <!-- Imprimer PDF -->
                <button onclick="exportToPDF()"
                    class="inline-flex items-center px-3 py-2 border border-transparent rounded-xl shadow-sm text-xs font-medium text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-colors">
                    <svg class="h-4 w-4 text-white mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9v4a2 2 0 00-2 2v2zma1 1 0 001 1h8a1 1 0 001-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2z" />
                    </svg>
                    Imprimer PDF
                </button>
            </div>
        </div>

        <!-- Table de données -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-sm" id="presences-table">
                <thead class="bg-slate-50 text-slate-500 font-medium uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-4 text-left">Nom & Prénom</th>
                        <th class="px-6 py-4 text-left">Adresse Email</th>
                        <th class="px-6 py-4 text-left">Date & Heure de pointage</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 bg-white" id="presences-rows">
                </tbody>
            </table>
        </div>
    </div>

    <!-- État initial / Vide -->
    <div id="empty-state" class="text-center py-16 bg-white rounded-2xl border border-slate-100 shadow-sm max-w-sm mx-auto">
        <div class="inline-flex p-3 rounded-full bg-slate-100 text-slate-400 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
        </div>
        <p class="text-sm font-semibold text-slate-900">Aucune session sélectionnée</p>
        <p class="mt-1 text-xs text-slate-500">Choisissez un créneau dans la liste déroulante ci-dessus.</p>
    </div>

    <!-- État de chargement -->
    <div id="loading-state" class="hidden text-center py-16">
        <svg class="animate-spin mx-auto h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <p class="mt-3 text-xs font-medium text-slate-500">Chargement des données satellites...</p>
    </div>

</div>

<!-- CDN de gestion de données -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>

<script>
    let currentPresencesData = [];
    let currentSessionTitle = "Session";

    async function loadPresences(sessionId) {
        const select = document.getElementById('session_select');
        currentSessionTitle = select.options[select.selectedIndex].text;

        const container = document.getElementById('presences-container');
        const emptyState = document.getElementById('empty-state');
        const loadingState = document.getElementById('loading-state');
        const rowsContainer = document.getElementById('presences-rows');
        const countElement = document.getElementById('presence-count');

        if (!sessionId) {
            container.classList.add('hidden');
            emptyState.classList.remove('hidden');
            currentPresencesData = [];
            return;
        }

        container.classList.add('hidden');
        emptyState.classList.add('hidden');
        loadingState.classList.remove('hidden');

        try {
            const response = await fetch(`/presences/session/${sessionId}`);
            if (!response.ok) throw new Error('Erreur réseau');

            const data = await response.json();
            currentPresencesData = data.presences;
            rowsContainer.innerHTML = '';

            if (currentPresencesData.length === 0) {
                rowsContainer.innerHTML = `
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-xs text-slate-400 italic">
                        Aucun enregistrement de présence pour cette session.
                    </td>
                </tr>
            `;
                countElement.textContent = "0 présence enregistrée";
            } else {
                countElement.textContent = `${currentPresencesData.length} présence(s) enregistrée(s)`;

                currentPresencesData.forEach(presence => {
                    const date = new Date(presence.created_at).toLocaleString('fr-FR', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    const tr = document.createElement('tr');
                    tr.className = "hover:bg-slate-50/70 transition-colors";
                    tr.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-900">${presence.agent.nom} ${presence.agent.prenom}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-slate-600 font-mono text-xs">${presence.agent.email}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-slate-500">${date}</td>
                `;
                    rowsContainer.appendChild(tr);
                });
            }

            loadingState.classList.add('hidden');
            container.classList.remove('hidden');

        } catch (error) {
            console.error(error);
            loadingState.classList.add('hidden');
            emptyState.classList.remove('hidden');
            alert("Une erreur est survenue lors de la récupération des données.");
        }
    }

    // --- EXPORTS ---

    function exportToExcel() {
        if (currentPresencesData.length === 0) return alert("Aucune donnée à exporter.");

        const dataForExcel = currentPresencesData.map(p => ({
            "Nom": p.agent ? p.agent.nom : 'N/A',
            "Prénom": p.agent ? p.agent.prenom : 'N/A',
            "Email": p.email,
            "Date d'enregistrement": new Date(p.created_at).toLocaleString('fr-FR'),
            "Latitude": p.latitude,
            "Longitude": p.longitude,
            "Précision (mètres)": Math.round(p.accuracy)
        }));

        const worksheet = XLSX.utils.json_to_sheet(dataForExcel);
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Présences");

        const fileName = `presences_${currentSessionTitle.replace(/[^a-z0-9]/gi, '_').toLowerCase()}.xlsx`;
        XLSX.writeFile(workbook, fileName);
    }

    function exportToPDF() {
        if (currentPresencesData.length === 0) return alert("Aucune donnée à imprimer.");

        const {
            jsPDF
        } = window.jspdf;
        // Création du document A4 en portrait
        const doc = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4'
        });

        const totalPresences = currentPresencesData.length;
        const generatedAt = new Date().toLocaleString('fr-FR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });

        // --- EN-TÊTE GRAPHIQUE ---
        // Titre Principal
        doc.setFont("Helvetica", "bold");
        doc.setFontSize(20);
        doc.setTextColor(15, 23, 42); // Slate 900
        doc.text("RAPPORT DE PRÉSENCES", 14, 20);

        // Ligne esthétique de séparation (Couleur Emerald 600)
        doc.setDrawColor(5, 150, 105);
        doc.setLineWidth(1);
        doc.line(14, 24, 196, 24);

        // Métadonnées de Session
        doc.setFont("Helvetica", "medium");
        doc.setFontSize(11);
        doc.setTextColor(51, 65, 85); // Slate 700
        doc.text(`Session : ${currentSessionTitle}`, 14, 32);

        doc.setFont("Helvetica", "normal");
        doc.setFontSize(9);
        doc.setTextColor(100, 116, 139); // Slate 500
        doc.text(`Généré le : ${generatedAt}`, 14, 38);

        // --- BLOC DE SYNTHÈSE / STATISTIQUES ---
        // Petit encadré gris clair pour afficher le résumé
        doc.setFillColor(248, 250, 252); // Slate 50
        doc.setDrawColor(241, 245, 249); // Slate 100
        doc.roundedRect(14, 43, 182, 14, 2, 2, "FD");

        doc.setFont("Helvetica", "bold");
        doc.setFontSize(10);
        doc.setTextColor(5, 150, 105); // Emerald 600
        doc.text(`Émargements enregistrés : ${totalPresences}`, 19, 52);

        // --- PRÉPARATION DES DONNÉES DU TABLEAU ---
        const bodyData = currentPresencesData.map((p, index) => [
            index + 1, // Indexation automatique des lignes
            p.agent ? `${p.agent.nom.toUpperCase()} ${p.agent.prenom}` : 'N/A',
            p.agent ? p.agent.email : 'N/A',
            new Date(p.created_at).toLocaleString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            })
        ]);

        // --- GÉNÉRATION DU TABLEAU ---
        doc.autoTable({
            startY: 64,
            margin: {
                left: 14,
                right: 14
            },
            head: [
                ["N°", "Collaborateur", "Adresse Email", "Date & Heure de Pointage"]
            ],
            body: bodyData,
            theme: 'striped',
            headStyles: {
                fillColor: [5, 150, 105], // Vert Emerald 600
                textColor: [255, 255, 255],
                fontStyle: 'bold',
                fontSize: 10,
                cellPadding: 4
            },
            alternateRowStyles: {
                fillColor: [248, 250, 252] // Slate 50 pour les lignes alternées
            },
            styles: {
                font: "Helvetica",
                fontSize: 9,
                textColor: [51, 65, 85], // Slate 700
                cellPadding: 3.5,
                verticalAlignment: 'middle'
            },
            columnStyles: {
                0: {
                    cellWidth: 12,
                    halign: 'center'
                }, // Colonne N° étroite et centrée
                1: {
                    fontStyle: 'bold'
                } // Nom de l'agent mis en gras
            },
            // Pied de page dynamique (Pagination "Page X sur Y")
            didDrawPage: function(data) {
                const totalPages = doc.internal.getNumberOfPages();
                doc.setFont("Helvetica", "normal");
                doc.setFontSize(8);
                doc.setTextColor(148, 163, 184); // Slate 400

                // Ligne discrète au-dessus du footer
                doc.setDrawColor(241, 245, 249);
                doc.setLineWidth(0.5);
                doc.line(14, 282, 196, 282);

                // Texte de pagination calé en bas à droite
                const pageText = `Page ${data.pageNumber} sur ${totalPages}`;
                doc.text(pageText, 196 - doc.getTextWidth(pageText), 288);

                // Note de bas de page à gauche
                doc.text("Document généré automatiquement via le système de suivi des présences.", 14, 288);
            }
        });

        // Nettoyage et normalisation du nom du fichier
        const fileName = `rapport_presences_${currentSessionTitle.replace(/[^a-z0-9]/gi, '_').toLowerCase()}.pdf`;
        doc.save(fileName);
    }
</script>
@endsection