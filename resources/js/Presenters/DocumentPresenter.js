import dayjs from "dayjs";

export default class DocumentPresenter {
    constructor(document) {
        this.document = document;
    }

    get id() {
        return this.document.id;
    }

    get name() {
        return this.document.name;
    }

    get published_at() {
        const months = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];
        const date = dayjs(this.document.published_at);
        const day = date.date().toString().padStart(2, '0');
        const month = months[date.month()];
        const year = date.year();
        return `${day} de ${month} de ${year}`;
    }

    get is_published() {
        return this.document.is_published;
    }

    get type() {
        return this.document.type;
    }

    get document_section() {
        return this.document.document_section;
    }

    get document_file() {
        return this.document.document_file;
    }

    get image() {
        return this.document.image;
    }
} 