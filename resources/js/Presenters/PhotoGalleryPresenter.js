import dayjs from "dayjs";

export default class PhotoGalleryPresenter {
    constructor(photoGallery) {
        this.photoGallery = photoGallery;
    }

    get id() {
        return this.photoGallery.id;
    }

    get name() {
        return this.photoGallery.name;
    }

    get is_published() {
        return this.photoGallery.is_published;
    }

    get published_at() {
        const months = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];
        const date = dayjs(this.photoGallery.published_at);
        const day = date.date().toString().padStart(2, '0');
        const month = months[date.month()];
        const year = date.year();
        return `${day} de ${month} de ${year}`;
    }

    get photos() {
        return this.photoGallery.photos;
    }

    get thumbnail() {
        return this.photoGallery.image;
    }
} 