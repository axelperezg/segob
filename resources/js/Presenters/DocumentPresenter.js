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

    get slug() {
        return this.document.slug;
    }

    get type() {
        return this.document.type;
    }

    get published_at() {
        const months = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];
        const date = dayjs(this.document.published_at);
        const day = date.date();
        const month = months[date.month()];
        const year = date.year();
        return `${day} de ${month} de ${year}`;
    }

    get image() {
        return this.document.image;
    }

    get document_file() {
        return this.document.document;
    }
} 
