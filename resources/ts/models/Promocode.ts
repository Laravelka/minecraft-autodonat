export interface Promocode {
    id: number;
    code: string;
    discount_percentage: number;
    valid_from: string | null;
    valid_until: string | null;
    created_at: string;
    updated_at: string;
}
