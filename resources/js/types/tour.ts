export interface TourPackage {
    id: number;
    title: string;
    slug: string;
    location: string;
    short_description: string;
    price: number;
    duration_days: number;
    duration_nights: number;
    max_capacity: number;
    thumbnail: string | null;
    is_active: boolean;
    created_at: string;
}