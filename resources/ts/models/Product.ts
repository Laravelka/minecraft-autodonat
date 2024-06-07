export interface Product {
    id: number;
    name: string;
    image: string;
    price: number;
    duration: 'month' | 'three_months' | 'forever' | null;
    extra_payment: boolean;
    category_id: number;
    luckperms_group: string;
    command_month: string | null;
    command_three_months: string | null;
    command_forever: string | null;
    allow_promocodes: boolean;
    server_id: number;
    description: string | null;
    created_at: string;
    updated_at: string;
}
