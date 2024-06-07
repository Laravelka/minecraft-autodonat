export interface PurchaseHistory {
    id: number;
    player_nickname: string;
    invoice_paid_at: string;
    player_email: string;
    invoice_price: number;
    issue_command: string;
    server_response?: string | null;
    user_id?: number | null;
    product_id: number;
    promocode_id?: number | null;
    server_id: number;
    created_at: string;
    updated_at: string;
}
